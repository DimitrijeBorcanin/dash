<?php

namespace App\Http\Livewire\Orders;

use Carbon\Carbon;
use Livewire\Component;

class ChangeStatus extends Component
{
    public $order;

    public function changeStatus($number){
        switch($number){
            case 0:
                $this->order->accepted = Carbon::now();
                $this->order->save();
                break;
            case 1:
                $this->order->manufacture = Carbon::now();
                $this->order->save();
                break;
            case 2:
                $this->order->made = Carbon::now();
                $this->order->save();
                break;
            case 3:
                $this->order->transit = Carbon::now();
                $this->order->save();
                break;
            case 4:
                $this->order->warehouse = Carbon::now();
                $this->order->save();
                break;
            case 5:
                $this->order->delivery = Carbon::now();
                $this->order->save();
                break;
            case 6:
                $this->order->paid = Carbon::now();
                $this->order->save();
                $this->emit("paid");
                break;
        }
    }

    public function render()
    {
        return view('livewire.orders.change-status');
    }
}
