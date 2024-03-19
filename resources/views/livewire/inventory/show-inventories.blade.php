<div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <a href="{{route('inventories.create')}}" class="flex cursor-pointer items-center hover:text-gray-500 px-3 md:px-0">
            <i class="fas fa-plus-square text-4xl pr-3"></i>
            <h2 class="text-2xl">
                Dodajte novu stavku
            </h2>
        </a>

        <x-jet-section-border />
        @if(Auth::user()->hasRoles([1]))
        <div class="w-full mb-3">
            <div class="w-full md:w-1/5">
                <x-jet-label for="location" value="Lokacija" />
                <select wire:model="filter.location" class="rounded-md block mt-1 w-full" id="location">
                    <option value="0">Sve</option>
                    @foreach($locations as $location)
                            <option value="{{$location['value']}}">{{$location['title']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
    
        <div class="overflow-x-auto w-full">
            <table class="min-w-full divide-y divide-gray-200 mb-3">
                <thead>
                    <tr>
                        <th class="w-1/6 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Vrsta proizvoda</th>
                        <th class="w-1/6 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Kod</th>
                        <th class="w-1/6 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Vrsta ploče</th>
                        <th class="w-1/6 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Naziv ploče</th>
                        <th class="w-1/6 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Oblik</th>
                        <th class="w-1/6 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Količina</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($inventories as $inventory)
                        <tr class="cursor-pointer hover:bg-gray-200" onclick="window.location = '{{ route('inventory', ['inventory' => $inventory->id]) }}'">
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <p>{{$inventory->type}}</p>
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <p>{{$inventory->code}}</p>
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <p>{{$inventory->top_type}}</p>
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <p>{{$inventory->top_name}}</p>
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <p>{{$inventory->top_shape}}</p>
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <p>{{$inventory->quantity}}</p>
                            </td>
                        </tr>
                    @empty 
                        <tr>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="6">Nemate ništa u magacinu ili nema stavki sa unetom pretragom.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    {{ $inventories->links('pagination.custom-pagination') }}
            </table>
        </div> 
    </div>
</div>