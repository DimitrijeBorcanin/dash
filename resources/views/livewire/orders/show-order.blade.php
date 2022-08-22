<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="flex justify-between mb-5 px-4 lg:px-0">
        <div>
            <a href="{{$previousPage}}" class="flex items-center text-blue-400 hover:text-blue-500">
                <i class="fas fa-caret-left mr-1"></i>
                <h5 class="text-lg">Nazad</h5>
            </a>
        </div>
        @if(!$isEdit)
        <div class="flex cursor-pointer items-center hover:text-gray-500 px-0" wire:click="toggleEdit()">
            <i class="fas fa-pen-square text-4xl"></i>
        </div>
        @endif
    </div>
    
    @if($isEdit)
        @include('livewire.orders.order-edit-form')
    @else
    <div class="grid grid-cols-8 gap-6">
        <div class="col-span-2 pr-5">
            <h2 class="text-3xl pb-3">Informacije o kupcu</h2>
            @empty(!$order->customer->name)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Ime i prezime:</p>
                <p class="text-2xl">{{$order->customer->name}}</p>
            </div>
            @endempty
            @empty(!$order->customer->email)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Email:</p>
                <p class="text-2xl">{{$order->customer->email}}</p>
            </div>
            @endempty
            @empty(!$order->customer->instagram)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Instagram:</p>
                <p class="text-2xl">{{$order->customer->instagram}}</p>
            </div>
            @endempty
            @empty(!$order->customer->phone)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Telefon:</p>
                <p class="text-2xl">{{$order->customer->phone}}</p>
            </div>
            @endempty
            @empty(!$order->customer->address)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Adresa i grad:</p>
                <p class="text-2xl">{{$order->customer->address_and_city}}</p>
            </div>
            @endempty
        </div>
        <div class="col-span-6 pl-5">
            <h2 class="text-3xl pb-3">Informacije o proizvodu</h2>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-3 pr-5">
                    @empty(!$order->product->code)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Kod:</p>
                        <p class="text-2xl">{{$order->product->code}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->type)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Vrsta proizvoda:</p>
                        <p class="text-2xl">{{$order->product->type}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->color)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Boja konstrukcije:</p>
                        <p class="text-2xl">{{$order->product->color}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->height)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Visina:</p>
                        <p class="text-2xl">{{$order->product->height}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->top_type)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Vrsta ploče:</p>
                        <p class="text-2xl">{{$order->product->top_type}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->dimensions)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Dimenzija ploče:</p>
                        <p class="text-2xl">{{$order->product->dimensions}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->top_shape)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Oblik ploče:</p>
                        <p class="text-2xl">{{$order->product->top_shape}}</p>
                    </div>
                    @endempty
                </div>
                <div class="col-span-3 pl-5">
                    @empty(!$order->product->edge_type)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Obrada ivice:</p>
                        <p class="text-2xl">{{$order->product->edge_type}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->protection)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Zaštita:</p>
                        <p class="text-2xl">{{$order->product->protection}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->quantity)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Količina:</p>
                        <p class="text-2xl">{{$order->product->quantity}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->transport)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Transport:</p>
                        <p class="text-2xl">{{$order->product->getAmountWithCurrency('transport')}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->price)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Cena:</p>
                        <p class="text-2xl">{{$order->product->getAmountWithCurrency('price')}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->deposit)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Kapara:</p>
                        <p class="text-2xl">{{$order->product->getAmountWithCurrency('deposit')}}</p>
                    </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
    @endif

    <x-jet-section-border />

    <div class="mt-3 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-7 gap-6 px-3 md:px-0">
        @livewire('orders.order-status', ['order' => $order, 'status' => "accepted", 'title' => "Za proizvodnju", 'roles' => [1,2,3]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "manufacture", 'title' => "U proizvodnji", 'roles' => [1,4]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "made", 'title' => "Proizvedeno", 'roles' => [1,4]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "transit", 'title' => "U tranzitu", 'roles' => [1,4]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "warehouse", 'title' => "U magacinu", 'roles' => [1,5]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "delivery", 'title' => "Isporučeno", 'roles' => [1,5]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "paid", 'title' => "Razduženje", 'roles' => [1]])
    </div>

    <x-jet-section-border />

    @livewire('orders.attachments', ["order" => $order])
    <x-jet-section-border />

    @livewire('orders.comments', ["order" => $order])
</div>