<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Throwable;

class CreateStock extends Component
{

    public $state = [
        "name" => "",
        "description" => "",
        "quantity" => "1"
    ];

    public function mount(Stock $stock){
        $this->stock = $stock;
    }

    public function createStock(){
        $this->validation($this->state);
        try {
            $stock = Stock::create($this->state);
            return redirect()->route('stock', ["stock" => $stock->id]);
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
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
    public function render()
    {
        return view('livewire.stock.create-stock');
    }
}
