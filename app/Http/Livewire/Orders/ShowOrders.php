<?php

namespace App\Http\Livewire\Orders;

use App\Exports\OrdersExport;
use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use Livewire\WithPagination;

class ShowOrders extends Component
{
    use WithPagination;

    public $customerId = null;

    private $pagination = 10;
    public $filter = [
        "search" => "",
        "status" => "0"
    ];

    public $statuses = [
        'Aktivno',
        'Za proizvodnju',
        'U proizvodnji',
        'Proizvedeno',
        'U tranzitu',
        'U magacinu',
        'Isporučeno'
    ];

    private function fetch(){
        $orders = Order::with(['customer', 'product']);
        if($this->customerId != null){
            $orders = $orders->where('customer_id', $this->customerId);
        }
        switch($this->filter["status"]){
            case '1': 
                $order = $orders->whereNull('accepted');
                break;
            case '2': 
                $orders = $orders->whereNotNull('accepted')->whereNull('manufacture');
                break;
            case '3': 
                $orders = $orders->whereNotNull('manufacture')->whereNull('made');
                break;
            case '4': 
                $orders = $orders->whereNotNull('made')->whereNull('transit');
                break;
            case '5': 
                $orders = $orders->whereNotNull('transit')->whereNull('warehouse');
                break;
            case '6': 
                $orders = $orders->whereNotNull('warehouse')->whereNull('delivery');
                break;
            case '7': 
                $orders = $orders->whereNotNull('delivery')->whereNull('paid');
                break;
            default:
                break;
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
        return $orders->active()->latest()->paginate($this->pagination);
    }

    public function updatingFilter(){
        $this->resetPage();
    }

    public function exportPdf(){
        $orders = $this->fetch();
        $pdf = app('dompdf.wrapper');
        $res = $pdf->loadView('livewire.orders.pdf', ["orders" => $orders])->output();
        return response()->streamDownload(function() use ($res) {
            print($res); 
        }, 'porudzbine.pdf');
    }

    public function exportExcel(){
        $orders = $this->fetch();
        return Excel::download(new OrdersExport($orders), 'porudzbine.xlsx');
    }

    public function render()
    {
        return view('livewire.orders.show-orders', ["orders" => $this->fetch()]);
    }
}
