<?php

namespace App\Http\Livewire\Orders;

use App\Enum\CurrencyEnum;
use App\Enum\EdgeTypeEnum;
use App\Enum\ProductTypeEnum;
use App\Enum\ProtectionEnum;
use App\Enum\QuantityEnum;
use App\Enum\TopShapeEnum;
use App\Enum\TopTypeEnum;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Throwable;

class ShowOrder extends Component
{
    public $order;
    protected $listeners = ["updateOrderStatus", "valueChanged" => "updateState"];
    public $previousPage;

    public $isEdit = false;
    public $state = [
        "code" => "",
        "type" => "",
        "dimensions" => "",
        "color" => "",
        "height" => "",
        "top_type" => "",
        "top_shape" => "",
        "edge_type" => "",
        "protection" => "",
        "quantity" => "",
        "transport" => "",
        "currency" => "",
        "price" => "",
        "deposit" => ""
    ];

    public $lists = [
        "type" => [],
        "height" => [],
        "top_type" => [],
        "top_shape" => [],
        "edge_type" => [],
        "protection" => [],
        "quantity" => [],
        "currency" => []
    ];

    public function mount(Order $order){
        $this->order = $order;

        if($order->paid && !Auth::user()->hasRoles([1])){
            abort(403);
        }

        $this->fetchLists();
        $this->setForm($order->product);

        $this->previousPage = url()->previous();
    }

    public function updateOrderStatus(\App\Models\Order $order){
        $this->order = $order;
    }

    public function toggleEdit(){
        $this->isEdit = !$this->isEdit;
    }

    private function fetchLists(){
        $this->lists["type"] = ProductTypeEnum::getList();
        // $this->lists["height"] = ProductTypeEnum::getList();
        $this->lists["top_type"] = TopTypeEnum::getList();
        $this->lists["top_shape"] = TopShapeEnum::getList();
        $this->lists["edge_type"] = EdgeTypeEnum::getList();
        $this->lists["protection"] = ProtectionEnum::getList();
        $this->lists["quantity"] = QuantityEnum::getList();
        $this->lists["currency"] = CurrencyEnum::getList();
    }

    private function setForm($product){
        $this->state["type"] = $product["type"];
        $this->state["code"] = $product["code"];
        $this->state["color"] = $product["color"];
        $this->state["height"] = $product["height"];
        $this->state["top_type"] = $product["top_type"];
        $this->state["dimensions"] = $product["dimensions"];
        $this->state["top_shape"] = $product["top_shape"];
        $this->state["edge_type"] = $product["edge_type"];
        $this->state["protection"] = $product["protection"];
        $this->state["quantity"] = $product["quantity"];
        $this->state["currency"] = $product["currency"];
        $this->state["transport"] = (int)$product["transport"];
        $this->state["price"] = (int)$product["price"];
        $this->state["deposit"] = (int)$product["deposit"];
    }

    public function updateProduct(){
        $this->validation($this->state);
        try {
            $this->order->product->update($this->state);
            $this->dispatchBrowserEvent('flashsuccess', ['message' => 'Uspešno izmenjen proizvod!']);
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        } finally {
            $this->toggleEdit();
            $this->setForm($this->order->product);
        }
    }

    private function validation($product){
        return Validator::make($product, [
            "code" => ['required', 'string', 'max:255'],
            "type" => ['required', 'string', 'max:255'],
            "dimensions" => ['required', 'string', 'max:255'],
            "color" => ['required', 'string', 'max:255'],
            "height" => ['required', 'string', 'max:255'],
            "top_type" => ['required', 'string', 'max:255'],
            "top_shape" => ['required', 'string', 'max:255'],
            "edge_type" => ['required', 'string', 'max:255'],
            "protection" => ['required', 'string', 'max:255'],
            "quantity" => ['required', 'string', 'max:255'],
            "transport" => ['required', 'numeric'],
            "currency" => ['required', 'string', 'max:255'],
            "price" => ['required', 'numeric'],
            "deposit" => ['required', 'numeric']
        ], [
            'code.required' => 'Kod je obavezan',
            'type.required' => 'Vrsta proizvoda je obavezna',
            'dimensions.required' => 'Dimenzija ploče je obavezna',
            'color.required' => 'Boja konstrukcije je obavezna',
            'height.required' => 'Visina je obavezna',
            'top_type.required' => 'Vrsta ploče je obavezna',
            'top_shape.required' => 'Oblik ploče je obavezan',
            'edge_type.required' => 'Obrada ivica je obavezna',
            'protection.required' => 'Zaštita je obavezna',
            'quantity.required' => 'Količina je obavezna',
            'transport.required' => 'Transport je obavezan',
            'transport.numeric' => 'Transport mora biti broj',
            'currency.required' => 'Moneta je obavezna',
            'price.required' => 'Cena je obavezna',
            'price.numeric' => 'Cena mora biti broj',
            'deposit.required' => 'Kapara je obavezna',
            'deposit.numeric' => 'Kapara mora biti broj'
        ])->validate();
    }

    public function cancelUpdate(){
        $this->toggleEdit();
        $this->setForm($this->order->product);
    }

    public function checkList($list, $value){
        $values = array_map(fn($value) => $value["value"], $this->lists[$list]);
        return in_array($value, $values);
    }

    public function updateState($state, $value){
        $this->state[$state] = $value;
    }

    public function render()
    {
        return view('livewire.orders.show-order');
    }
}
