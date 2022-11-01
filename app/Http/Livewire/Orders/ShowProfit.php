<?php

namespace App\Http\Livewire\Orders;

use App\Enum\CurrencyEnum;
use App\Exports\ProfitExport;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ShowProfit extends Component
{
    use WithPagination;

    private $pagination = 10;
    public $filter = [
        "search" => "",
        "year" => "0",
        "month" => "0"
    ];

    public $months = [
        "Januar",
        "Februar",
        "Mart",
        "April",
        "Maj",
        "Jun",
        "Jul",
        "Avgust",
        "Septembar",
        "Oktobar",
        "Novembar",
        "Decembar"
    ];

    public $totalRSD = 0;
    public $totalEUR = 0;

    private function fetch(){
        $orders = Order::whereNotNull('paid');
        if($this->filter["year"] != 0){
            $orders = $orders->whereYear('paid', $this->filter["year"]);
        }
        if($this->filter["month"] != 0){
            $orders = $orders->whereMonth('paid', $this->filter["month"]);
        }
        $orders = $orders->where(function($query){
            $query->whereHas('customer', function($query){
                $query->where('name', 'like', '%'.$this->filter["search"].'%')
                        ->orWhere('email', 'like', '%'.$this->filter["search"].'%')
                        ->orWhere('instagram', 'like', '%'.$this->filter["search"].'%')
                        ->orWhere('phone', 'like', '%'.$this->filter["search"].'%')
                        ->orWhere('address', 'like', '%'.$this->filter["search"].'%')
                        ->orWhere('city', 'like', '%'.$this->filter["search"].'%');
            })
            ->orWhereHas('product', function($query){
                $query->where('code', 'like', '%'.$this->filter["search"].'%')
                        ->orWhere('type', 'like', '%'.$this->filter["search"].'%');
            });
        });

        $this->getTotal($orders->get());

        return $orders->orderBy('paid', 'desc')->paginate($this->pagination);
    }

    private function getTotal($orders){
        $totalRSD = 0;
        $totalEUR = 0;
        foreach($orders as $order){
            if($order->product->currency == CurrencyEnum::RSD->value){
                $totalRSD += $order->product->profit;
            } else {
                $totalEUR += $order->product->profit;
            }
        }
        $this->totalRSD = number_format($totalRSD, 2, ",", ".");
        $this->totalEUR = number_format($totalEUR, 2, ",", ".");
    }

    public function updatingFilter(){
        $this->resetPage();
    }

    public function exportExcel(){
        return Excel::download(new ProfitExport($this->fetch(), $this->totalRSD, $this->totalEUR), 'obracun' . ($this->filter["year"] ? ('_' . $this->filter["year"]) : '') . ($this->filter["month"] ? ('_' . $this->filter["month"]) : '') . '.xlsx');
    }

    public function render()
    {
        return view('livewire.orders.show-profit', ["orders" => $this->fetch()]);
    }
}
