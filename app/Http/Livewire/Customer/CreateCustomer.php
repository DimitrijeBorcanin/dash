<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Throwable;

class CreateCustomer extends Component
{
    public $state = [
        "name" => "",
        "email" => "",
        "instagram" => "",
        "phone" => "",
        "address" => "",
        "city" => ""
    ];

    public function createCustomer(){
        $this->validation($this->state);
        try {
            $customer = Customer::create($this->state);
            return redirect()->route('customer', ["customer" => $customer->id]);
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        }
    }

    public function cancelCreate(){
        $this->toggleEdit();
        $this->setForm($this->customer);
    }

    private function validation($customer){
        return Validator::make($customer, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'required_without_all:instagram,phone'],
            'instagram' => ['string', 'max:255', 'required_without_all:email,phone'],
            'phone' => ['string', 'max:255', 'required_without_all:instagram,email'],
            'address' => ['string', 'max:255'],
            'city' => ['string', 'max:255']
        ], [
            'name.required' => 'Ime je obavezno',
            'name.string' => 'Ime mora biti tekstualnog tipa',
            'name.max' => 'Ime ne može biti duže od :max karaktera',
            'email.required' => 'Email je obavezan',
            'email.email' => 'Email mora biti ispravnog formata',
            'email.required_without_all' => 'Email mora biti popunjen ako su telefon i instagram prazni',
            'instagram.string' => 'Instagram mora biti tekstualnog tipa',
            'instagram.max' => 'Instagram ne može biti duži od :max karaktera',
            'instagram.required_without_all' => 'Instagram mora biti popunjen ako su email i telefon prazni',
            'phone.string' => 'Telefon mora biti tekstualnog tipa',
            'phone.max' => 'Telefon ne može biti duži od :max karaktera',
            'phone.required_without_all' => 'Telefon mora biti popunjen ako su email i instagram prazni',
            'address.string' => 'Adresa mora biti tekstualnog tipa',
            'address.max' => 'Adresa ne može biti duža od :max karaktera',
            'city.string' => 'Grad mora biti tekstualnog tipa',
            'city.max' => 'Grad ne može biti duži od :max karaktera'
        ])->validate();
    }

    public function render()
    {
        return view('livewire.customer.create-customer');
    }
}
