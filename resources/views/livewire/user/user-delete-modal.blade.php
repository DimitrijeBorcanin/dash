<x-jet-confirmation-modal wire:model="deleteModalVisible">
    <x-slot name="title">
        Obrišite zaposlenog
    </x-slot>

    <x-slot name="content">
        @if($userToDelete != null)
        Da li ste siguni da želite da obrišete radnika <b>{{$userToDelete['name']}}</b>?
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelDelete" wire:loading.attr="disabled">
            Odustani
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
            Obriši
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>