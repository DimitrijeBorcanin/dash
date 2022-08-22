<div>
    <div class="bg-white rounded shadow w-full p-4 mb-3" >
        @if(!$isEdit)
        <div>
            <div class="pb-3">
                {{$originalComment}}
            </div>
            <hr>
            <div class="pt-3 flex justify-between text-sm">
                <div>
                    <span class="font-bold">{{$user}}</span> 
                    <span class="italic">{{$date}}</span>
                </div>
                @can('updateAndDelete', $comment)
                <div>
                    <span class="mr-3 cursor-pointer" wire:click="showEdit">Izmeni</span>
                    <span class="text-red-500 cursor-pointer" wire:click="deleteComment">Obriši</span>
                </div>
                @endcan
            </div>
        </div>
        @else
        <!-- EDIT --->
        @can('updateAndDelete', $comment)
        <div>
            <form wire:submit.prevent="saveEdit">
                <div class="pb-3">
                    <textarea wire:model.defer="state.text" class="w-full border-2 rounded resize-none p-3"></textarea>
                </div>
                <hr>
                <div class="pt-3 flex justify-between text-sm">
                    <div>
                    </div>
                    <div>
                        <x-jet-secondary-button wire:click="cancelEdit" wire:loading.attr="disabled">
                            {{ __('Odustani') }}
                        </x-jet-secondary-button>
                        <x-jet-button class="ml-2" wire:loading.attr="disabled">
                            {{ __('Izmeni') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
        @endcan
        @endif
    </div>
</div>