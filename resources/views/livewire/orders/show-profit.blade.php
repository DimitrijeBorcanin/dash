<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="w-full mb-3 px-3 md:px-0 flex justify-between flex-col md:flex-row">
        <div class="w-full md:w-1/4">
            <x-jet-label for="search" value="Pretraga" />
            <x-jet-input id="search" type="text" class="mt-1 block w-full" wire:model.debounce.300ms="filter.search" />
            <x-jet-input-error for="search" class="mt-2" />
        </div>
        <div class="w-full md:w-1/4 flex">
            <div class="w-1/2 mr-3">
                <x-jet-label for="year" value="Godina" />
                <select wire:model="filter.year" class="rounded-md block mt-1 w-full" id="year">
                    <option value="0">Sve</option>
                    @for($i = \Carbon\Carbon::now()->year; $i >= 2022; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="w-1/2">
                <x-jet-label for="month" value="Mesec" />
                <select wire:model="filter.month" class="rounded-md block mt-1 w-full" id="month">
                    <option value="0">Svi</option>
                    @foreach($months as $index => $month)
                            <option value="{{$index + 1}}">{{$month}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="min-w-full divide-y divide-gray-200 mb-3">
            <thead>
                <tr>
                    <th class="w-1/6 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="w-1/4 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Proizvod</th>
                    <th class="w-1/4 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Kupac</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orders as $order)
                    <tr class="cursor-pointer hover:bg-gray-200" onclick="window.location = '{{ route('order', ['customer' => $order->customer_id, 'order' => $order->id]) }}'">
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                            <p>{{$order->id}}</p>
                            @if($order->product->linked)
                            <p>Veza ID{{$order->product->linked}}</p>
                            @endif
                            {{-- @if($order->part) 
                            <p>({{$order->part}})</p>
                            @endif --}}
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                            <p>{{$order->product->code}}</p>
                            <p>{{$order->product->dimensions}}</p>
                            <p>{{$order->product->price}} RSD</p>
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                            <p>{{$order->customer->name}}</p>
                            <p>{{$order->customer->email}}</p>
                            <p>{{$order->customer->instagram}}</p>
                            <p>{{$order->customer->phone}}</p>
                            <p>{{$order->customer->address_and_city}}</p>
                        </td>
                    </tr>
                @empty 
                    <tr>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">Nemate nijednu porudžbinu ili nema porudžbine za odabran status.</td>
                    </tr>
                @endforelse
                </tbody>
                {{ $orders->links('pagination.custom-pagination') }}
        </table>
    </div>    

    <div class="px-3 md:px-0 flex justify-between">
        <div>
            <x-jet-button wire:click="exportExcel" wire:loading.attr="disabled">
                <i class="fas fa-file-excel pr-2 text-base"></i>{{ __('Excel') }}
            </x-jet-button>
        </div>
        <div class="text-right">
            <p>Ukupno:</p>
            <p class="text-2xl">{{$totalRSD}} RSD</p>
            <p class="text-2xl">{{$totalEUR}} EUR</p>
        </div>
    </div>
</div>