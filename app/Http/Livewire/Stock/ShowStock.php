<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Throwable;

class ShowStock extends Component
{
    public $stock;

    public $isEdit = false;
    public $state = [
        "name" => "",
        "description" => "",
        "quantity" => "1"
    ];

    public $deleteModal = false;

    public function mount(Stock $stock){
        $this->stock = $stock;
        $this->setForm($stock);
    }

    public function toggleEdit(){
        $this->isEdit = !$this->isEdit;
    }

    private function setForm($stock){
        $this->state["name"] = $stock["name"];
        $this->state["description"] = $stock["description"];
        $this->state["quantity"] = $stock["quantity"];
    }

    public function updateStock(){
        $this->validation($this->state);
        try {
            $this->stock->update($this->state);
            $this->dispatchBrowserEvent('flashsuccess', ['message' => 'Uspešno izmenjeno!']);
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        } finally {
            $this->toggleEdit();
            $this->setForm($this->stock);
        }
    }

    private function validation($stock){
        return Validator::make($stock, [
            "name" => ['required', 'string', 'max:255'],
            "description" => ['nullable', 'string'],
            "quantity" => ['required', 'integer', 'min:1']
        ], [
            'name.required' => 'Naziv je obavezan',
            'name.max' => 'Naziv je predug',
            'quantity.required' => 'Količina je obavezna',
            'quantity.min' => 'Količina mora biti veća od 1'
        ])->validate();
    }

    public function cancelUpdate(){
        $this->toggleEdit();
        $this->setForm($this->stock);
    }

    public function showDeleteModal(){
        $this->deleteModal = true;
    }

    public function deleteStock(){
        try {
            $this->stock->delete();
            return redirect()->route('stocks');
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        }
    }

    public function cancelDelete(){
        $this->deleteModal = false;
    }

    public function render()
    {
        return view('livewire.stock.show-stock');
    }
}
