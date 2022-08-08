<div>
    <x-jet-label for="{{$inputId}}" value="{{$title}}" />
    @if($isSelect)
    <select wire:model="value" class="form-input rounded-md shadow-sm block mt-1 w-full py-2" id="{{$inputId}}" wire:change="checkIfOther($event.target.value)">
        <option value="">Izaberite...</option>
        @foreach($list as $item)
                <option value="{{$item["value"]}}">{{$item["title"]}}</option>
        @endforeach
        <option value="other">Ostalo</option>
    </select>
    @else
    <div class="flex">
        <x-jet-input id="{{$inputId}}" type="text" class="mt-1 grow" wire:model="value" wire:keyup="customInputChange()" />
        <div class="flex cursor-pointer items-center hover:text-gray-500 ml-3" wire:click="closeCustomInput()">
            <i class="fas fa-rectangle-xmark text-4xl"></i>
        </div>
    </div>
    @endif
    <x-jet-input-error for="{{$inputId}}" class="mt-2" />
</div>