<div>
    <div>
        @foreach($attachments as $attachment)
        <div class="w-full bg-gray-300 rounded py-2 px-4 flex justify-between mb-3">
            <div>
                <a href="{{asset('files')}}/{{$attachment->path}}" download><i class="fas fa-file"></i> {{$attachment->path}}</a>
            </div>
            <div class="cursor-pointer" wire:click="showDeleteModal({{$attachment}})">
                <i class="fas fa-times"></i>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-3 flex justify-between flex-col md:flex-row">
        <div>
            <input type="file" name="attachment" wire:model="attachment" id="attachment" />
            <x-jet-input-error for="attachment" class="mt-2" />
        </div>
        <div class="w-full flex justify-end">
            <x-jet-button wire:click="upload" wire:loading.attr="disabled">
                {{ __('Dodaj') }}
            </x-jet-button>
        </div>
    </div>

    <x-jet-confirmation-modal wire:model="deleteModalVisible">
        <x-slot name="title">
            Obrišite atačment
        </x-slot>
    
        <x-slot name="content">
            Da li ste siguni da želite da obrišete atačment?
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelDelete" wire:loading.attr="disabled">
                Odustani
            </x-jet-secondary-button>
    
            <x-jet-danger-button class="ml-2" wire:click="deleteAttachment" wire:loading.attr="disabled">
                Obriši
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
