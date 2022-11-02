<div>
    <div class="mb-3">
        <p class="text-xs">Trenutni status:</p>
        <p class="font-bold">{{$order->currentStatus}}</p>
    </div>
    <div>
        @switch($order->currentStatusNumber)
            @case(0)
                @if(Auth::user()->hasRoles([1,2,3,4,5]))
                    <div class="flex items-center justify-end">
                        <p class="mr-3">Za proizvodnju</p> 
                        <i onclick="event.stopPropagation()" class="fas fa-check-square text-xl text-gray-400 hover:text-green-500" wire:click="changeStatus(0)"></i>
                    </div>
                @endif
                @break
            @case(1)
                @if(Auth::user()->hasRoles([1,4]))
                    <div class="flex items-center justify-end">
                        <p class="mr-3">U proizvodnji</p> 
                        <i onclick="event.stopPropagation()" class="fas fa-check-square text-xl text-gray-400 hover:text-green-500" wire:click="changeStatus(1)"></i>
                    </div>
                @endif
                @break
            @case(2)
                @if(Auth::user()->hasRoles([1,4]))
                    <div class="flex items-center justify-end">
                        <p class="mr-3">Proizvedeno</p> 
                        <i onclick="event.stopPropagation()" class="fas fa-check-square text-xl text-gray-400 hover:text-green-500" wire:click="changeStatus(2)"></i>
                    </div>
                @endif
                @break
            @case(3)
                @if(Auth::user()->hasRoles([1,4]))
                    <div class="flex items-center justify-end">
                        <p class="mr-3">U tranzitu</p> 
                        <i onclick="event.stopPropagation()" class="fas fa-check-square text-xl text-gray-400 hover:text-green-500" wire:click="changeStatus(3)"></i>
                    </div>
                @endif
                @break
            @case(4)
                @if(Auth::user()->hasRoles([1,5]))
                    <div class="flex items-center justify-end">
                        <p class="mr-3">U magacinu</p> 
                        <i onclick="event.stopPropagation()" class="fas fa-check-square text-xl text-gray-400 hover:text-green-500" wire:click="changeStatus(4)"></i>
                    </div>
                @endif
                @break
            @case(5)
                @if(Auth::user()->hasRoles([1,5]))
                    <div class="flex items-center justify-end">
                        <p class="mr-3">Isporučeno</p> 
                        <i onclick="event.stopPropagation()" class="fas fa-check-square text-xl text-gray-400 hover:text-green-500" wire:click="changeStatus(5)"></i>
                    </div>
                @endif
                @break
            @case(6)
                @if(Auth::user()->hasRoles([1]))
                    <div class="flex items-center justify-end">
                        <p class="mr-3">Razduženje</p> 
                        <i onclick="event.stopPropagation()" class="fas fa-check-square text-xl text-gray-400 hover:text-green-500" wire:click="changeStatus(6)"></i>
                    </div>
                @endif
                @break
        @endswitch
    </div>
</div>
