<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="flex justify-between mb-5 px-4 lg:px-0">
        <div>
            <a href="{{$previousPage}}" class="flex items-center text-blue-400 hover:text-blue-500">
                <i class="fas fa-caret-left mr-1"></i>
                <h5 class="text-lg">Nazad</h5>
            </a>
        </div>
        <div class="flex">
            @if(!$isEdit && Auth::user()->hasRoles([1,2,3,5]))
            <div class="flex cursor-pointer items-center hover:text-gray-500 px-0" wire:click="toggleEdit()">
                <i class="fas fa-pen-square text-4xl"></i>
            </div>
            @endif
            @if(!$isEdit && Auth::user()->hasRoles([1]))
            <div class="flex cursor-pointer items-center text-red-700 hover:text-red-500 px-0 ml-3" wire:click="showDeleteModal()">
                <i class="fas fa-trash text-2xl"></i>
            </div>
            @endif
        </div>
    </div>

    <div class="mb-3 flex items-center justify-between flex-col md:flex-row">
        <h1 class="text-3xl mr-5">ID {{ $order->id }}</h1>
        <div class="flex items-center">
            <div class="mr-5">
                <p class="text-sm">Datum poručivanja:</p>
                <p class="font-bold">{{$order->formatted_created_at}}</p>
            </div>
            <div class="mr-5">
                <i class="fa-solid fa-arrow-right"></i>
            </div>
            <div>
                <p class="text-sm">30 dana:</p>
                <p class="font-bold">{{$order->formatted_month_later}}</p>
            </div>
        </div>
    </div>
    
    @if($isEdit && Auth::user()->hasRoles([1,2,3,5]))
        @include('livewire.orders.order-edit-form')
    @else
    <div class="grid grid-cols-8 gap-6 px-5 md:px-0">
        <div class="col-span-8 md:col-span-2 md:pr-5">
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
        <div class="col-span-8 md:col-span-6 md:pl-5">
            <h2 class="text-3xl pb-3">Informacije o proizvodu</h2>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 md:col-span-3 pr-5">
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
                    @empty(!$order->product->top_name)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Naziv ploče:</p>
                        <p class="text-2xl">{{$order->product->top_name}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->dimensions)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Dimenzija ploče:</p>
                        <p class="text-2xl">{{$order->product->dimensions}}</p>
                    </div>
                    @endempty
                </div>
                <div class="col-span-6 md:col-span-3 md:pl-5">
                    @empty(!$order->product->top_shape)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Oblik ploče:</p>
                        <p class="text-2xl">{{$order->product->top_shape}}</p>
                    </div>
                    @endempty
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
                    @if(Auth::user()->hasRoles([1,2,3,5]))
                    @empty(!$order->product->transport)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Prevoz Dash:</p>
                        <p class="text-2xl">{{$order->product->getAmountWithCurrency('transport')}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->transport_customer)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Prevoz kupac:</p>
                        <p class="text-2xl">{{$order->product->getAmountWithCurrency('transport_customer')}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->price)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Cena:</p>
                        <p class="text-2xl">{{$order->product->getAmountWithCurrency('price')}}</p>
                    </div>
                    @endempty
                    @empty(!$order->product->deposit)
                    <div class="mb-3 border-b-2 border-dotted flex justify-between items-center">
                        <div>
                            <p class="italic text-gray-500">Kapara:</p>
                            <p class="text-2xl">{{$order->product->getAmountWithCurrency('deposit')}}</p>
                        </div>
                        <i 
                            class="fas fa-check-square text-2xl 
                            @if(Auth::user()->hasRoles([1,2,3,5])) cursor-pointer @endif 
                            @if($order->deposit_paid)text-green-500 @else text-gray-200 @endif" 
                            @if(Auth::user()->hasRoles([1,2,3,5])) wire:click="toggleDepositPaid" @endif
                        >
                        </i>
                    </div>
                    @endempty
                    @empty(!$order->product->remaining_amount_with_currency)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Ostalo za naplatu:</p>
                        <p class="text-2xl">{{$order->product->remaining_amount_with_currency}}</p>
                    </div>
                    @endempty
                    @endif
                    @empty(!$order->product->linked)
                    <div class="mb-3 border-b-2 border-dotted">
                        <p class="italic text-gray-500">Vezano za:</p>
                        <p class="text-2xl">ID {{$order->product->linked}}</p>
                    </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
    @endif
   
    @if(Auth::user()->hasRoles([1]))
    <x-jet-section-border />
    @include('livewire.orders.notification-checkboxes')
    @endif

    <x-jet-section-border />

    <div class="mt-3 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-7 gap-6 px-3 md:px-0">
        @if(Auth::user()->hasRoles([1,2,3,4,5]))
        @livewire('orders.order-status', ['order' => $order, 'status' => "accepted", 'title' => "Za proizvodnju", 'roles' => [1,2,3,4,5]])
        @endif
        @livewire('orders.order-status', ['order' => $order, 'status' => "manufacture", 'title' => "U proizvodnji", 'roles' => [1,4]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "made", 'title' => "Proizvedeno", 'roles' => [1,4]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "transit", 'title' => "U tranzitu", 'roles' => [1,4]])
        @if(Auth::user()->hasRoles([1,2,3,4,5]))
        @livewire('orders.order-status', ['order' => $order, 'status' => "warehouse", 'title' => "U magacinu", 'roles' => [1,4,5]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "delivery", 'title' => "Isporučeno", 'roles' => [1,4,5]])
        @livewire('orders.order-status', ['order' => $order, 'status' => "paid", 'title' => "Razduženje", 'roles' => [1]])
        @endif
    </div>

    <x-jet-section-border />

    <div class="px-5">
        @livewire('orders.attachments', ["order" => $order])
    </div>
    <x-jet-section-border />

    @livewire('orders.comments', ["order" => $order])

    @include('livewire.orders.delete-order')
</div>