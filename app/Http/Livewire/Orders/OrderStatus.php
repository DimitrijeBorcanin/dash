<?php

namespace App\Http\Livewire\Orders;

use Carbon\Carbon;
use Livewire\Component;

class OrderStatus extends Component
{
    public $order;
    public $status;
    public $title;
    public $roles;

    public function toggle($field){
        // if($this->order["canceled"]){
        //     return;
        // }
        if($this->order[$field]){
            $this->order[$field] = null;
            $this->order->save();
        } else {
            $this->order[$field] = Carbon::now();
            $this->order->save(); 
        }
        $this->emit('updateOrderStatus', $this->order);
    }

    public function render()
    {
        return view('livewire.orders.order-status');
    }
}
