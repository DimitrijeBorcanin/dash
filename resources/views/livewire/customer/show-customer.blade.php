<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="flex justify-between mb-5 px-4 lg:px-0">
        <div>
            <a href="{{route('customers')}}" class="flex items-center text-blue-400 hover:text-blue-500">
                <i class="fas fa-caret-left mr-1"></i>
                <h5 class="text-lg">Kupci</h5>
            </a>
            <h2 class="text-2xl pb-3 text-center lg:text-left">Informacije o kupcu</h2>
        </div>
        @if(!$isEdit)
        <div class="flex cursor-pointer items-center hover:text-gray-500 px-0" wire:click="toggleEdit()">
            <i class="fas fa-pen-square text-4xl"></i>
        </div>
        @endif
    </div>
    @if($isEdit)
        @include('livewire.customer.customer-edit-form')
    @else
    <div class="grid grid-cols-5 gap-3 text-center lg:text-left">
        @empty(!$customer->name)
        <div class="mb-3 col-span-5 lg:col-span-1">
            <p class="italic text-sm text-gray-500">Ime i prezime:</p>
            <p class="text-xl">{{$customer->name}}</p>
        </div>
        @endempty
        @empty(!$customer->email)
        <div class="mb-3 col-span-5 lg:col-span-1">
            <p class="italic text-sm text-gray-500">Email:</p>
            <p class="text-xl">{{$customer->email}}</p>
        </div>
        @endempty
        @empty(!$customer->instagram)
        <div class="mb-3 col-span-5 lg:col-span-1">
            <p class="italic text-sm text-gray-500">Instagram:</p>
            <p class="text-xl">{{$customer->instagram}}</p>
        </div>
        @endempty
        @empty(!$customer->phone)
        <div class="mb-3 col-span-5 lg:col-span-1">
            <p class="italic text-sm text-gray-500">Telefon:</p>
            <p class="text-xl">{{$customer->phone}}</p>
        </div>
        @endempty
        @empty(!$customer->address_and_city)
        <div class="mb-3 col-span-5 lg:col-span-1">
            <p class="italic text-sm text-gray-500">Adresa i grad:</p>
            <p class="text-xl">{{$customer->address_and_city}}</p>
        </div>
        @endempty
    </div>
    @endif

    <x-jet-section-border />
</div>
