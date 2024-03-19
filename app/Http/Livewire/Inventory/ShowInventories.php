<?php

namespace App\Http\Livewire\Inventory;

use App\Enum\LocationEnum;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowInventories extends Component
{
    use WithPagination;

    private $pagination = 10;
    public $filter = [
        "location" => ""
    ];

    public $locations = [];

    public function mount(){
        $this->fetchLists();
    }

    private function fetchLists(){
        $this->locations = LocationEnum::getList();
    }

    private function fetch(){
        $inventories = Inventory::query();
        if(Auth::user()->role_id == 1 && $this->filter["location"] != 0){
            $inventories = $inventories->where('location', 'like', '%' . $this->filter["location"] . '%');
        } else {
            $inventories = $inventories->where('location', 'like', '%' . Auth::user()->location . '%');
        }

        return $inventories->latest()->paginate($this->pagination);
    }

    public function updatingFilter(){
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.inventory.show-inventories', ["inventories" => $this->fetch()]);
    }
}
