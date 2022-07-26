<div class="flex cursor-pointer items-center hover:text-gray-500 px-3 md:px-0" wire:click="showFormModal">
    <i class="fas fa-plus-square text-4xl pr-3"></i>
    <h2 class="text-2xl">
        Dodajte novog zaposlenog
    </h2>
</div>

<x-jet-dialog-modal wire:model="formModalVisible">
    <x-slot name="title">
        Dodajte zapolsenog
    </x-slot>

    <x-slot name="content">
        <form>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4 mb-4">
                <x-jet-label for="name" value="Ime" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="user.name" autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
    
            <!-- Email -->
            <div class="col-span-6 sm:col-span-4 mb-4">
                <x-jet-label for="email" value="Email" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="user.email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="col-span-6 sm:col-span-4 mb-4">
                <x-jet-label for="password" value="Lozinka" />
                <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="user.password" autocomplete="password" />
                <x-jet-input-error for="password" class="mt-2" />
            </div>
    
            <div class="col-span-6 sm:col-span-4 mb-4">
                <x-jet-label for="password_confirmation" value="Potvrda lozinke" />
                <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="user.password_confirmation" autocomplete="password" />
                <x-jet-input-error for="password_confirmation" class="mt-2" />
            </div>
    
            <div class="col-span-6 sm:col-span-4 mb-4">
                <x-jet-label for="role_id" value="Uloga" />
                <select wire:model.defer="user.role_id" class="form-input rounded-md shadow-sm block mt-1 w-full py-2" id="role_id">
                    <option value="0">Izaberite...</option>
                    @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="role_id" class="mt-2" />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelSave" wire:loading.attr="disabled">
            {{ __('Odustani') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="saveUser" wire:loading.attr="disabled">
            {{ __('Dodaj') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>