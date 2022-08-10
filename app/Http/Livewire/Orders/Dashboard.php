<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    private $pagination = 10;
    public $filter = [
        "search" => ""
    ];

    private function fetch(){
        return Order::with(['customer', 'product'])
                        ->latest()
                        ->paginate($this->pagination);
    }

    public function updatingFilter(){
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.orders.dashboard');
    }
}
