<div>
    <x-jet-label for="{{$inputId}}" value="{{$title}}" />
    @if($isSelect)
    <select wire:model="value" class="form-input rounded-md shadow-sm block mt-1 w-full py-2 pr-5" id="{{$inputId}}" wire:change="checkIfOther($event.target.value)">
        <option value="">Izaberite...</option>
        @foreach($list as $item)
                <option value="{{$item["value"]}}" wire:key="{{$item["value"]}}">{{$item["title"]}}</option>
        @endforeach
        <option value="other" wire:key="other">Ostalo</option>
    </select>
    @else
    <div class="relative">
        <x-jet-input id="{{$inputId}}" type="text" class="w-full pr-9" wire:model="value" wire:keyup="customInputChange()" />
        <div class="absolute top-1 right-3">
            <div class="flex cursor-pointer items-center text-gray-400 hover:text-gray-500 ml-3 items-center z-10" wire:click="closeCustomInput()">
                <i class="fas fa-xmark text-2xl"></i>
            </div>
        </div>
    </div>
    @endif
    {{-- <x-jet-input-error for="{{$inputId}}" class="mt-2" /> --}}
</div>