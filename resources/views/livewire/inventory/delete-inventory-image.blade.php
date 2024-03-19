<x-jet-confirmation-modal wire:model="deleteImageModal">
    <x-slot name="title">
        Brisanje
    </x-slot>

    <x-slot name="content">
        Da li ste siguni da želite da obrišete sliku?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelDeleteImage" wire:loading.attr="disabled">
            Odustani
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click="deleteImage" wire:loading.attr="disabled">
            Obriši
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>