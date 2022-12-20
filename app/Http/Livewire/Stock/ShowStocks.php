<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;

class ShowStocks extends Component
{
    use WithPagination;

    private $pagination = 10;

    public $filter = [
        "search" => ""
    ];

    private function fetch(){
        $stocks = Stock::latest()->paginate($this->pagination);
        return $stocks;
    }

    public function updatingFilter(){
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.stock.show-stocks', ["stocks" => $this->fetch()]);
    }
}
