<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProfitExport implements FromView, ShouldAutoSize
{
    protected $orders;
    protected $totalRSD;
    protected $totalEUR;

    public function __construct($orders, $totalRSD, $totalEUR)
    {
        $this->orders = $orders;
        $this->totalRSD = $totalRSD;
        $this->totalEUR = $totalEUR;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('livewire.orders.profit-excel', [
            "orders" => $this->orders,
            "totalRSD" => $this->totalRSD,
            "totalEUR" => $this->totalEUR
        ]);
    }
}
