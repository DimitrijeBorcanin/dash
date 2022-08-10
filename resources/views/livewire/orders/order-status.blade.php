<div class="bg-white shadow p-3 rounded overflow-hidden flex items-center justify-between">
    <div>
        <p>{{$title}}</p>
        <p class="text-xs italic text-gray-500">{{$order[$status]}}</p>
    </div>
    <i 
        class="fas fa-check-square text-2xl 
        @if(Auth::user()->hasRoles($roles)) cursor-pointer @endif 
        @if($order[$status])text-green-500 @else text-gray-200 @endif" 
        @if(Auth::user()->hasRoles($roles)) wire:click="toggle('{{$status}}')" @endif
    >
    </i>
</div>
