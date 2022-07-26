<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-jet-form-section submit="createCustomer">
        <x-slot name="title">
            Dodajte novog kupca
        </x-slot>
    
        <x-slot name="description">
            
        </x-slot>
    
        <x-slot name="form">      
            <!-- Name -->
            <div class="col-span-6 lg:col-span-2">
                <x-jet-label for="name" value="Ime" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <!-- Email -->
            <div class="col-span-6 lg:col-span-2">
                <x-jet-label for="email" value="Email" />
                <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="state.email" autocomplete="email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
            <!-- Instagram -->
            <div class="col-span-6 lg:col-span-2">
                <x-jet-label for="instagram" value="Instagram" />
                <x-jet-input id="instagram" type="text" class="mt-1 block w-full" wire:model.defer="state.instagram" autocomplete="instagram" />
                <x-jet-input-error for="instagram" class="mt-2" />
            </div>
            <!-- Phone -->
            <div class="col-span-6 lg:col-span-2">
                <x-jet-label for="phone" value="Telefon" />
                <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" autocomplete="phone" />
                <x-jet-input-error for="phone" class="mt-2" />
            </div>
            <!-- Address -->
            <div class="col-span-6 lg:col-span-2">
                <x-jet-label for="address" value="Adresa" />
                <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" autocomplete="address" />
                <x-jet-input-error for="address" class="mt-2" />
            </div>
            <!-- City -->
            <div class="col-span-6 lg:col-span-2">
                <x-jet-label for="city" value="Grad" />
                <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="state.city" autocomplete="city" />
                <x-jet-input-error for="city" class="mt-2" />
            </div>
        </x-slot>
    
        <x-slot name="actions">
            <a href="{{route('customers')}}">
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