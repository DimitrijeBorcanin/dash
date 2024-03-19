<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-jet-form-section submit="createInventory">
        <x-slot name="title">
            Dodajte novu stavku u magacin
        </x-slot>
    
        <x-slot name="description">
            
        </x-slot>
    
        <x-slot name="form">
            <div class="col-span-6 grid grid-cols-6 gap-6">
                <!-- Type -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["list" => $lists["type"], "model" => "state.type", "title" => "Vrsta proizvoda", "inputId" => "type", "state" => "type"])
                    <x-jet-input-error for="type" class="mt-2" />
                </div>  
                <!-- Code -->
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="code" value="Kod" />
                    <x-jet-input id="code" type="text" class="mt-1 block w-full" wire:model.defer="state.code" autocomplete="code" />
                    <x-jet-input-error for="code" class="mt-2" />
                </div>
                <!-- Lccation -->
                @if(Auth::user()->hasRoles([1]))
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="location" value="Lokacija" />
                    <select wire:model="state.location" class="form-input rounded-md shadow-sm block mt-1 w-full py-2" id="location">
                        <option value="0">Izaberite...</option>
                        @foreach($lists["location"] as $location)
                                <option value="{{$location['value']}}">{{$location['title']}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="location" class="mt-2" />
                </div>
                @endif
            </div>
            <div class="col-span-6 my-5">
            </div>
            <div class="col-span-6 grid grid-cols-6 gap-6">
                <!-- Color -->
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="color" value="Boja" />
                    <x-jet-input id="color" type="text" class="mt-1 block w-full" wire:model.defer="state.color" autocomplete="color" />
                    <x-jet-input-error for="color" class="mt-2" />
                </div>
                <!-- Top type -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["list" => $lists["top_type"], "model" => "state.top_type", "title" => "Vrsta ploče", "inputId" => "top_type", "state" => "top_type"])
                    <x-jet-input-error for="top_type" class="mt-2" />
                </div>
                <!-- Top name -->
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="top_name" value="Naziv ploče" />
                    <x-jet-input id="top_name" type="text" class="mt-1 block w-full" wire:model.defer="state.top_name" autocomplete="top_name" />
                    <x-jet-input-error for="top_name" class="mt-2" />
                </div>
                <!-- Dimensions -->
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="dimensions" value="Dimenzije" />
                    <x-jet-input id="dimensions" type="text" class="mt-1 block w-full" wire:model.defer="state.dimensions" autocomplete="dimensions" />
                    <x-jet-input-error for="dimensions" class="mt-2" />
                </div>
                <!-- Top shape -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["list" => $lists["top_shape"], "model" => "state.top_shape", "title" => "Oblik ploče", "inputId" => "top_shape", "state" => "top_shape"])
                    <x-jet-input-error for="top_shape" class="mt-2" />
                </div>
                <!-- Quantity -->
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="quantity" value="Količina" />
                    <x-jet-input id="quantity" type="text" class="mt-1 block w-full" wire:model.defer="state.quantity" />
                    <x-jet-input-error for="quantity" class="mt-2" />
                </div>
            </div>
            <div class="col-span-6 my-5">
            </div>
            <div class="col-span-6 grid grid-cols-11 gap-6">
                <div class="col-span-11">
                    <x-jet-label for="description" value="Opis" />
                    <textarea id="description" class="mt-1 block w-full" wire:model.defer="state.description"></textarea>
                    <x-jet-input-error for="description" class="mt-2" />
                </div>
            </div>
            <div class="col-span-6 grid grid-cols-11 gap-6">
                <div class="col-span-6">
                    <x-jet-label for="image" value="Slika" />
                    <input type="file" id="image" class="mt-1 block" wire:model.defer="state.image" />
                    <x-jet-input-error for="image" class="mt-2" />
                </div>
            </div>
            
        </x-slot>
    
        <x-slot name="actions">
            <a href="{{route('inventories')}}">
                <x-jet-secondary-button class="mr-3">
                    Otkaži
                </x-jet-secondary-button>
            </a>

            <x-jet-action-message class="mr-3" on="saved">
                Sačuvano
            </x-jet-action-message>
    
            <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                Sačuvaj
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>