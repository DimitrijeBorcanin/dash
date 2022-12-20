<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="flex justify-between mb-5 px-4 lg:px-0">
        <div>
            <a href="{{route('stocks')}}" class="flex items-center text-blue-400 hover:text-blue-500">
                <i class="fas fa-caret-left mr-1"></i>
                <h5 class="text-lg">Nazad</h5>
            </a>
        </div>
        <div class="flex">
            @if(!$isEdit && Auth::user()->hasRoles([1]))
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
        <h1 class="text-3xl mr-5">ID {{ $stock->id }}</h1>
    </div>
    
    @if($isEdit && Auth::user()->hasRoles([1]))
        @include('livewire.stock.stock-edit-form')
    @else
    <div class="grid grid-cols-8 gap-6 px-5 md:px-0">
        <div class="col-span-8 md:col-span-8">
            <h2 class="text-3xl pb-3">Informacije</h2>
            @empty(!$stock->name)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Naziv:</p>
                <p class="text-2xl">{{$stock->name}}</p>
            </div>
            @endempty
            @empty(!$stock->description)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Opis:</p>
                <p class="text-2xl">{{$stock->description}}</p>
            </div>
            @endempty
            @empty(!$stock->quantity)
            <div class="mb-3 border-b-2 border-dotted">
                <p class="italic text-gray-500">Količina:</p>
                <p class="text-2xl">{{$stock->quantity}}</p>
            </div>
            @endempty
        </div>
    </div>
    @endif

    @include('livewire.stock.delete-stock')
</div>