<?php

namespace App\Http\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Livewire\Component;
use Livewire\WithPagination;
use PDOException;
use Throwable;

class ShowUsers extends Component
{
    use WithPagination;

    public $user = [
        "name" => '',
        "email" => '',
        "password" => '',
        "password_confirmation" => '',
        "role_id" => '0'
    ];

    private $pagination = 10;
    public $filter = [
        "search" => ""
    ];

    public $formModalVisible = false;
    public $userToEdit = null;

    public $deleteModalVisible = false;
    public $userToDelete = null;

    private function fetch(){
        return User::where('id', '<>', 1)
                    ->where(function($query) {
                        $query->where('name', 'like', '%'.$this->filter["search"].'%')
                        ->orWhere('email', 'like', '%'.$this->filter["search"].'%');
                    })
                    ->latest()
                    ->paginate($this->pagination);
    }

    public function updatingFilter(){
        $this->resetPage();
    }

    private function resetForm(){
        $this->user = [
            "name" => '',
            "email" => '',
            "password" => '',
            "password_confirmation" => '',
            "role_id" => '0'
        ];
    }

    private function setForm($user){
        $this->user["name"] = $user["name"];
        $this->user["email"] = $user["email"];
        $this->user["role_id"] = $user["role_id"];
    }

    private function validation($user, $isEdit = false, $userId = 0){
        return Validator::make($this->user, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $isEdit ?  Rule::unique('users')->ignore($userId) : 'unique:users'],
            'password' => [$isEdit ? '' : 'required', 'string', new Password, 'confirmed'],
            'role_id' => ['required', 'not_in:0,1', 'exists:roles,id'],
        ], [
            'name.required' => 'Ime je obavezno.',
            'name.max' => 'Ime je predugačko.',
            'email.required' => 'Email je obavezan.',
            'email.email' => 'Email nije dobrog formata.',
            'email.max' => 'Email je predugačak.',
            'email.unique' => 'Email već postoji.',
            'password.required' => 'Lozinka je obavezna.',
            'password.confirmed' => 'Potvrda lozinka se ne podudara sa lozinkom.',
            'password.min' => 'Lozinka mora biti bar 8 karaktera.',
            'role_id.required' => 'Uloga je obavezna.',
            'role_id.not_in' => 'Uloga nije izabrana.',
            'role_id.exists' => 'Uloga ne postoji u bazi.',
        ])->validate();
    }

    /* FORM METHODS */

    public function showFormModal($user = null){
        $this->userToEdit = $user;
        if($user != null){
            $this->setForm($user);
        }
        $this->formModalVisible = true;
    }

    public function cancelSave(){
        $this->formModalVisible = false;
        $this->userToEdit = null;
        $this->resetForm();
    }

    public function saveUser(){
        try {
            if($this->userToEdit != null){
                $user = User::find($this->userToEdit['id']);
                $this->validation($this->user, true, $user->id);
                $user->name = $this->user["name"];
                $user->email = $this->user["email"];
                $user->role_id = $this->user["role_id"];
                if(!empty($this->user["password"]) && !empty($this->user["password_confirmation"])){
                    $user->password = Hash::make($this->user["password"]);
                }
                $user->save();
                $this->dispatchBrowserEvent('flashsuccess', ['message' => 'Uspešno izmenjen zaposleni!']);
            } else {
                $this->validation($this->user);
                User::create($this->user);
                $this->dispatchBrowserEvent('flashsuccess', ['message' => 'Uspešno dodat zaposleni!']);
            } 
            $this->formModalVisible = false;
            $this->resetPage();
            $this->userToEdit = null;
            $this->resetForm();
        } catch (PDOException $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        }
    }

    /* ROLE */
    public function updateRole($userId, $value){
        try {
            $user = User::find($userId);
            $user->update(["role_id" => $value]);
            $this->dispatchBrowserEvent('flashsuccess', ['message' => 'Uspešno izmenjena uloga!']);
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        }
    }

    /* DELETE METHODS */

     public function showDeleteModal($user){
        $this->userToDelete = $user;
        $this->deleteModalVisible = true;
    }

    public function cancelDelete(){
        $this->deleteModalVisible = false;
        $this->userToDelete = null;
    }

    public function deleteUser(){
        if($this->userToDelete != null){
            try {
                $user = User::find($this->userToDelete['id']);
                $user->delete();
                $this->dispatchBrowserEvent('flashsuccess', ['message' => 'Uspešno obrisan zaposleni!']);
            } catch (Throwable $e){
                $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
                if(env('APP_ENV') == 'local'){
                    dd($e->getMessage());
                }
            } finally {
                $this->deleteModalVisible = false;
                $this->resetPage();
                $this->userToDelete = null;
            }
        }
    }

    public function render()
    {
        return view('livewire.user.show-users', [
            'users' => $this->fetch(),
            'roles' => Role::all()
        ]);
    }
}
