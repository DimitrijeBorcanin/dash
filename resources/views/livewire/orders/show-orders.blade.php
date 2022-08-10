<div>
    <div class="w-full mb-3 px-3 md:px-0">
        <x-jet-label for="search" value="Pretraga" />
        <x-jet-input id="search" type="text" class="mt-1 block w-full md:w-1/4" wire:model="filter.search" />
        <x-jet-input-error for="search" class="mt-2" />
    </div>
    <div class="overflow-x-auto w-full">
        <table class="min-w-full divide-y divide-gray-200 mb-3">
            <thead>
                <tr>
                    <th class="w-1/6 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="w-1/4 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Proizvod</th>
                    <th class="w-1/4 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Kupac</th>
                    <th class="w-1/6 px-6 py-3 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orders as $order)
                    <tr class="cursor-pointer hover:bg-gray-200" onclick="window.location = '{{ route('order', ['customer' => $order->customer_id, 'order' => $order->id]) }}'">
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                            <p>{{$order->id}}</p>
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
                        <td class="px-6 py-4 text-sm whitespace-no-wrap text-right">
                            <div>
                                @livewire('orders.change-status', ["key" => now(), "order" => $order])
                            </div>
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
</div>