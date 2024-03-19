<?php

namespace App\Http\Livewire\Inventory;

use App\Enum\LocationEnum;
use App\Enum\ProductTypeEnum;
use App\Enum\TopShapeEnum;
use App\Enum\TopTypeEnum;
use App\Models\Inventory;
use Closure;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Location;
use Throwable;

class CreateInventory extends Component
{
    use WithFileUploads;

    public $state = [
        "code" => "",
        "type" => "",
        "dimensions" => "",
        "color" => "",
        "top_type" => "",
        "top_name" => "",
        "top_shape" => "",
        "quantity" => "1",
        "description" => "",
        "image" => "",
        "location" => "0"
    ];

    public $lists = [
        "type" => [],
        "top_type" => [],
        "top_shape" => [],
        "location" => [],
    ];

    protected $listeners = ["valueChanged" => "updateState"];
    public function updateState($state, $value){
        $this->state[$state] = $value;
    }

    public function mount(){
        $this->fetchLists();
    }

    public function createInventory(){
        $this->validation($this->state);
        if(!Auth::user()->hasRoles([1])){
            $this->state["location"] = Auth::user()->location;
        }

        try {
            if($this->state["image"] != ""){
                $imageName = time();
                $imageExtension = $this->state["image"]->extension();
                $this->state["image"]->storeAs('images\inventory', $imageName . '.' . $imageExtension);
                $this->state["image"] = $imageName . '.' . $imageExtension;
            }

            $inventory = Inventory::create($this->state);
            return redirect()->route('inventory', ["inventory" => $inventory->id]);
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        }
    }

    private function validation($inventory){
        return Validator::make($inventory, [
            "code" => ['required', 'string', 'max:255'],
            "type" => ['required', 'string', 'max:255'],
            "dimensions" => ['required', 'string', 'max:255'],
            "color" => ['required', 'string', 'max:255'],
            "top_type" => ['required', 'string', 'max:255'],
            "top_name" => ['string', 'max:255'],
            "top_shape" => ['required', 'string', 'max:255'],
            "quantity" => ['required', 'integer'],
            "description" => ['nullable', 'string'],
            "image" => ['nullable', 'image', 'mimes:jpg,png,bmp', 'max:8000'],
            "location" => [
                function (string $attribute, mixed $value, Closure $fail){
                    if((empty($value) || $value == 0) && Auth::user()->hasRoles([1])){
                        $fail("Lokacija je obavezna");
                    }

                    $flag = false;
                    foreach(LocationEnum::getList() as $location){
                        if($value == $location['value']){
                            $flag = true;
                            break;
                        }
                    }
                    if(!$flag){
                        $fail("Lokacija je ne postoji");
                    }
                },
            ]
        ], [
            'code.required' => 'Kod je obavezan',
            'type.required' => 'Vrsta proizvoda je obavezna',
            'dimensions.required' => 'Dimenzija ploče je obavezna',
            'color.required' => 'Boja konstrukcije je obavezna',
            'top_type.required' => 'Vrsta ploče je obavezna',
            'top_shape.required' => 'Oblik ploče je obavezan',
            'quantity.required' => 'Količina je obavezna'
        ])->validate();
    }

    private function fetchLists(){
        $this->lists["type"] = ProductTypeEnum::getList();
        $this->lists["top_type"] = TopTypeEnum::getList();
        $this->lists["top_shape"] = TopShapeEnum::getList();
        $this->lists["location"] = LocationEnum::getList();
    }

    public function render()
    {
        return view('livewire.inventory.create-inventory');
    }
}
