<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

use function Symfony\Component\String\b;

class SelectOther extends Component
{
    public $list;
    public $model;
    public $title;
    public $inputId;
    public $state;

    public $isSelect = true;
    public $value = "";

    public function mount($list, $model, $title, $inputId, $state){
        $this->list = $list;
        $this->model = $model;
        $this->title = $title;
        $this->inputId = $inputId;
        $this->state = $state;
    }

    public function checkIfOther($value){
        if($value == 'other'){
            $this->value = "";
            $this->isSelect = false;
        }
        $this->emit('valueChanged', $this->state, $this->value);
    }

    public function customInputChange(){
        $this->emit('valueChanged', $this->state, $this->value);
    }

    public function closeCustomInput(){
        $this->value = "";
        $this->isSelect = true;
        $this->emit('valueChanged', $this->state, $this->value);
    }

    public function render()
    {
        return view('livewire.forms.select-other');
    }
}
