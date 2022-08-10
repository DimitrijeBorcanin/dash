<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ShowOrders extends Component
{
    use WithPagination;

    public $customerId = null;

    private $pagination = 10;
    public $filter = [
        "search" => ""
    ];

    private function fetch(){
        $orders = Order::with(['customer', 'product']);
        if($this->customerId != null){
            $orders = $orders->where('customer_id', $this->customerId);
        }
        return $orders->active()->latest()->paginate($this->pagination);
    }

    public function updatingFilter(){
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.orders.show-orders', ["orders" => $this->fetch()]);
    }
}
