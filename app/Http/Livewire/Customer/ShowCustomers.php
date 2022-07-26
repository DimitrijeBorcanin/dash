<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCustomers extends Component
{
    use WithPagination;

    private $pagination = 10;
    public $filter = [
        "search" => ""
    ];

    private function fetch(){
        return Customer::where(function($query) {
                            $query->where('name', 'like', '%'.$this->filter["search"].'%')
                            ->orWhere('email', 'like', '%'.$this->filter["search"].'%')
                            ->orWhere('instagram', 'like', '%'.$this->filter["search"].'%')
                            ->orWhere('phone', 'like', '%'.$this->filter["search"].'%')
                            ->orWhere('address', 'like', '%'.$this->filter["search"].'%')
                            ->orWhere('city', 'like', '%'.$this->filter["search"].'%');
                        })
                        ->latest()
                        ->paginate($this->pagination);
    }

    public function updatingFilter(){
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.customer.show-customers', ["customers" => $this->fetch()]);
    }
}
