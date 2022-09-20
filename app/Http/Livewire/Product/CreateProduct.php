<?php

namespace App\Http\Livewire\Product;

use App\Enum\CurrencyEnum;
use App\Enum\EdgeTypeEnum;
use App\Enum\HeightEnum;
use App\Enum\ProductTypeEnum;
use App\Enum\ProtectionEnum;
use App\Enum\QuantityEnum;
use App\Enum\TopShapeEnum;
use App\Enum\TopTypeEnum;
use App\Mail\OrderAccepted;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Throwable;

class CreateProduct extends Component
{
    public $customer; 

    public $state = [
        "code" => "",
        "type" => "",
        "dimensions" => "",
        "color" => "",
        "height" => "",
        "top_type" => "",
        "top_name" => "",
        "top_shape" => "",
        "edge_type" => "",
        "protection" => "",
        "quantity" => "",
        "transport" => "",
        "currency" => "",
        "price" => "",
        "deposit" => "",
        "linked" => ""
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

    protected $listeners = ["valueChanged" => "updateState"];
    public function updateState($state, $value){
        $this->state[$state] = $value;
    }

    public function mount(Customer $customer){
        $this->customer = $customer;

        $this->fetchLists();
    }

    public function createProduct(){
        $this->validation($this->state);
        try {
            // if(empty($this->state["linked"])){
            //     $this->state["linked"] = null;
            // }
            $product = Product::create($this->state);
            $order = Order::create(["product_id" => $product->id, "customer_id" => $this->customer->id]);
            // if($order->customer->email){
            //     Mail::to($order->customer->email)->send(new OrderAccepted($order));
            // }
            return redirect()->route('customer', ["customer" => $this->customer->id]);
        } catch (Throwable $e){
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
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
            "top_name" => ['string', 'max:255'],
            "top_shape" => ['required', 'string', 'max:255'],
            "edge_type" => ['required', 'string', 'max:255'],
            "protection" => ['required', 'string', 'max:255'],
            "quantity" => ['required', 'string', 'max:255'],
            "transport" => ['required', 'numeric'],
            "currency" => ['required', 'string', 'max:255'],
            "price" => ['required', 'numeric'],
            "deposit" => ['required', 'numeric'],
            "linked" => ['nullable', 'integer']
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

    private function fetchLists(){
        $this->lists["type"] = ProductTypeEnum::getList();
        $this->lists["height"] = HeightEnum::getList();
        $this->lists["top_type"] = TopTypeEnum::getList();
        $this->lists["top_shape"] = TopShapeEnum::getList();
        $this->lists["edge_type"] = EdgeTypeEnum::getList();
        $this->lists["protection"] = ProtectionEnum::getList();
        $this->lists["quantity"] = QuantityEnum::getList();
        $this->lists["currency"] = CurrencyEnum::getList();
    }

    public function render()
    {
        return view('livewire.product.create-product');
    }
}
