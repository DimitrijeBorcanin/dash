<x-jet-confirmation-modal wire:model="deleteModal">
    <x-slot name="title">
        Brisanje
    </x-slot>

    <x-slot name="content">
        Da li ste siguni da želite da obrišete stavku?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelDelete" wire:loading.attr="disabled">
            Odustani
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click="deleteInventory" wire:loading.attr="disabled">
            Obriši
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>