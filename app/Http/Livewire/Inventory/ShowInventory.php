<?php

namespace App\Http\Livewire\Inventory;

use App\Enum\LocationEnum;
use App\Enum\ProductTypeEnum;
use App\Enum\TopShapeEnum;
use App\Enum\TopTypeEnum;
use App\Models\Inventory;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class ShowInventory extends Component
{
    use WithFileUploads;
    
    public $inventory;

    public $isEdit = false;
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

    public function checkList($list, $value){
        $values = array_map(fn($value) => $value["value"], $this->lists[$list]);
        return in_array($value, $values);
    }

    public $deleteModal = false;
    public $deleteImageModal = false;

    public function mount(Inventory $inventory){
        if(!Auth::user()->hasRoles([1]) && Auth::user()->location != $inventory->location){
            abort(403);
        }

        $this->fetchLists();
        $this->inventory = $inventory;
        $this->setForm($inventory);
    }

    private function fetchLists(){
        $this->lists["type"] = ProductTypeEnum::getList();
        $this->lists["top_type"] = TopTypeEnum::getList();
        $this->lists["top_shape"] = TopShapeEnum::getList();
        $this->lists["location"] = LocationEnum::getList();
    }

    public function toggleEdit(){
        $this->isEdit = !$this->isEdit;
    }

    private function setForm($inventory){
        $this->state["code"] = $inventory["code"];
        $this->state["type"] = $inventory["type"];
        $this->state["dimensions"] = $inventory["dimensions"];
        $this->state["color"] = $inventory["color"];
        $this->state["top_type"] = $inventory["top_type"];
        $this->state["top_name"] = $inventory["top_name"];
        $this->state["top_shape"] = $inventory["top_shape"];
        $this->state["quantity"] = $inventory["quantity"];
        $this->state["description"] = $inventory["description"];
        // $this->state["image"] = $inventory["image"];
        $this->state["location"] = $inventory["location"];
    }

    public function updateInventory(){
        if(Auth::user()->location != $this->inventory->location && Auth::user()->role_id != 1){
            return;
        }
        
        $this->validation($this->state);

        if(!Auth::user()->hasRoles([1])){
            $this->state["location"] = $this->inventory["location"];
        }

        try {

            if($this->state["image"] != ""){
                $imageName = time();
                $imageExtension = $this->state["image"]->extension();
                $this->state["image"]->storeAs('images\inventory', $imageName . '.' . $imageExtension);
                $this->state["image"] = $imageName . '.' . $imageExtension;

                Storage::delete('images\inventory\\' . $this->inventory["image"]);
            } else {
                $this->state["image"] = $this->inventory["image"];
            }

            $this->inventory->update($this->state);
            $this->dispatchBrowserEvent('flashsuccess', ['message' => 'Uspešno izmenjeno!']);
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        } finally {
            $this->toggleEdit();
            $this->setForm($this->inventory);
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
            "image" => ['nullable', 'image', 'mimes:jpg,png,bmp', 'max:2048'],
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

    public function cancelUpdate(){
        $this->toggleEdit();
        $this->setForm($this->stock);
    }

    public function showDeleteModal(){
        $this->deleteModal = true;
    }

    public function showDeleteImageModal(){
        $this->deleteImageModal = true;
    }

    public function deleteInventory(){
        try {
            $this->inventory->delete();
            return redirect()->route('inventories');
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        }
    }

    public function deleteImage(){
        try {
            Storage::delete('images\inventory\\' . $this->inventory["image"]);
            $this->inventory->image = "";
            $this->inventory->save();
            $this->deleteImageModal = false;
            $this->dispatchBrowserEvent('flashsuccess', ['message' => 'Uspešno obrisana slika!']);
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        }
    }

    public function cancelDelete(){
        $this->deleteModal = false;
    }

    public function cancelDeleteImage(){
        $this->deleteImageModal = false;
    }

    public function render()
    {
        return view('livewire.inventory.show-inventory');
    }
}
