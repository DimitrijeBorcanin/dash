<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-jet-form-section submit="createStock">
        <x-slot name="title">
            Dodajte novu stavku u magacin
        </x-slot>
    
        <x-slot name="description">
            
        </x-slot>
    
        <x-slot name="form">
            <div class="col-span-6 grid grid-cols-6 gap-6">
                <div class="col-span-6 lg:col-span-4">
                    <x-jet-label for="name" value="Naziv" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="quantity" value="Količina" />
                    <x-jet-input id="quantity" type="text" class="mt-1 block w-full" wire:model.defer="state.quantity" />
                    <x-jet-input-error for="quantity" class="mt-2" />
                </div>
            </div>
            <div class="col-span-6 grid grid-cols-6 gap-6 mb-5">
                <div class="col-span-6">
                    <x-jet-label for="description" value="Opis" />
                    <textarea id="description" class="mt-1 block w-full" wire:model.defer="state.description"></textarea>
                    <x-jet-input-error for="description" class="mt-2" />
                </div>
            </div>
        </x-slot>
    
        <x-slot name="actions">
            <a href="{{route('stocks')}}">
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