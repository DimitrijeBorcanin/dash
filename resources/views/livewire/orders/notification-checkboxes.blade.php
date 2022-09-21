<div class="flex flex-col md:flex-row">
    <div class="flex items-center md:mr-10 mb-5 md:mb-0">
        <input 
            class="h-5 w-5 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 mr-2" 
            type="checkbox" 
            value="" 
            id="topOrdered"
            @if($order->top_ordered)
            checked
            disabled
            @else
            wire:change="setNotificationCheckbox('top_ordered')"
            @endif
        />
        <label class="text-lg" for="topOrdered">
          Poručena ploča
        </label>
    </div>
    <div class="flex items-center">
        <input 
            class="h-5 w-5 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 mr-2" 
            type="checkbox" 
            value="" 
            id="instructionsSent"
            @if($order->instructions_sent)
            checked
            disabled
            @else
            wire:change="setNotificationCheckbox('instructions_sent')"
            @endif
        />
        <label class="text-lg" for="instructionsSent">
          Poslate instrukcije za sečenje
        </label>
    </div>
</div>