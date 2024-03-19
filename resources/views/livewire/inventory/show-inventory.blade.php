<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="flex justify-between mb-5 px-4 lg:px-0">
        <div>
            <a href="{{route('inventories')}}" class="flex items-center text-blue-400 hover:text-blue-500">
                <i class="fas fa-caret-left mr-1"></i>
                <h5 class="text-lg">Nazad</h5>
            </a>
        </div>
        <div class="flex">
            @if(!$isEdit)
            <div class="flex cursor-pointer items-center hover:text-gray-500 px-0" wire:click="toggleEdit()">
                <i class="fas fa-pen-square text-4xl"></i>
            </div>
            @endif
            @if(!$isEdit)
            <div class="flex cursor-pointer items-center text-red-700 hover:text-red-500 px-0 ml-3" wire:click="showDeleteModal()">
                <i class="fas fa-trash text-2xl"></i>
            </div>
            @endif
        </div>
    </div>

    <div class="mb-3 flex items-center justify-between flex-col md:flex-row">
        <h1 class="text-3xl mr-5">ID {{ $inventory->id }}</h1>
    </div>
    
    @if($isEdit)
        @include('livewire.inventory.inventory-edit-form')
    @else

    <h2 class="text-3xl pb-3">Informacije</h2>
    <div class="grid grid-cols-8 gap-6 px-5 md:px-0">
        <div class="col-span-8 md:col-span-4">
            @empty(!$inventory->type)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Vrsta proizvoda:</p>
                <p class="text-2xl">{{$inventory->type}}</p>
            </div>
            @endempty
            @empty(!$inventory->code)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Kod:</p>
                <p class="text-2xl">{{$inventory->code}}</p>
            </div>
            @endempty
            @empty(!$inventory->location)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Lokacija:</p>
                <p class="text-2xl">{{$inventory->location}}</p>
            </div>
            @endempty
            @empty(!$inventory->color)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Boja:</p>
                <p class="text-2xl">{{$inventory->color}}</p>
            </div>
            @endempty
            @empty(!$inventory->top_type)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Vrsta ploče:</p>
                <p class="text-2xl">{{$inventory->top_type}}</p>
            </div>
            @endempty
        </div>
        <div class="col-span-8 md:col-span-4">
            @empty(!$inventory->top_name)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Naziv ploče:</p>
                <p class="text-2xl">{{$inventory->top_name}}</p>
            </div>
            @endempty
            @empty(!$inventory->dimensions)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Dimenzije:</p>
                <p class="text-2xl">{{$inventory->dimensions}}</p>
            </div>
            @endempty
            @empty(!$inventory->top_shape)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Oblik:</p>
                <p class="text-2xl">{{$inventory->top_shape}}</p>
            </div>
            @endempty
            @empty(!$inventory->quantity)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Količina:</p>
                <p class="text-2xl">{{$inventory->quantity}}</p>
            </div>
            @endempty
            @empty(!$inventory->description)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Opis:</p>
                <p class="text-2xl">{{$inventory->description}}</p>
            </div>
            @endempty
        </div>
    </div>

        @empty(!$inventory->image)
            <div class="flex flex-col px-5 md:px-0 w-full md:w-1/2 mt-2">
                <div class="w-full">
                    <img src="{{asset('images/inventory/' . $inventory->image)}}" alt="{{$inventory->code}}" width="100%" />
                </div>
                <div class="w-full my-2">
                    <div class="flex cursor-pointer items-center text-red-700 hover:text-red-500 px-0 w-full justify-center bg-red-100 py-2 rounded-md" wire:click="showDeleteImageModal()">
                        <i class="fas fa-trash text-2xl"></i>
                    </div>
                </div>
            </div>
        @endempty
    @endif

    @include('livewire.inventory.delete-inventory')
    @include('livewire.inventory.delete-inventory-image')
</div>