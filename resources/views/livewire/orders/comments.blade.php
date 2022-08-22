<div>
    <div class="bg-white rounded shadow w-full p-4">
        <div class="pb-3">
            <textarea class="w-full border-2 rounded resize-none p-3" wire:model.defer="state.comment"></textarea>
        </div>
        <hr>
        <div class="pt-3 flex justify-between text-sm">
            <div>
            </div>
            <div>
                <x-jet-button class="ml-2" wire:click="addComment" wire:loading.attr="disabled">
                    {{ __('Dodaj') }}
                </x-jet-button>
            </div>
        </div>
    </div>

    <div class="py-4">
        @forelse($comments as $index => $comment)
            @livewire('orders.comment', ["comment" => $comment], key(time()))
        @empty
        @endforelse
    </div>

    <x-jet-confirmation-modal wire:model="deleteModalVisible">
        <x-slot name="title">
            Obrišite komentar
        </x-slot>
    
        <x-slot name="content">
            Da li ste siguni da želite da obrišete komentar?
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelDelete" wire:loading.attr="disabled">
                Odustani
            </x-jet-secondary-button>
    
            <x-jet-danger-button class="ml-2" wire:click="deleteComment" wire:loading.attr="disabled">
                Obriši
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
