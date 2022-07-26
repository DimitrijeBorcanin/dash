<div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <a href="{{route('stocks.create')}}" class="flex cursor-pointer items-center hover:text-gray-500 px-3 md:px-0">
            <i class="fas fa-plus-square text-4xl pr-3"></i>
            <h2 class="text-2xl">
                Dodajte novu stavku
            </h2>
        </a>

        <x-jet-section-border />
        <div class="w-full md:w-1/4 mb-3">
            <x-jet-label for="search" value="Pretraga" />
            <x-jet-input id="search" type="text" class="mt-1 block w-full" wire:model.debounce.300ms="filter.search" />
            <x-jet-input-error for="search" class="mt-2" />
        </div>
    
    <div class="overflow-x-auto w-full">
        <table class="min-w-full divide-y divide-gray-200 mb-3">
            <thead>
                <tr>
                    <th class="w-1/3 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Naziv</th>
                    <th class="w-1/3 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Opis</th>
                    <th class="w-1/3 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Količina</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($stocks as $stock)
                    <tr class="cursor-pointer hover:bg-gray-200" onclick="window.location = '{{ route('stock', ['stock' => $stock->id]) }}'">
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                            <p>{{$stock->name}}</p>
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                            <p>{{Str::limit($stock->description, 50, "...")}}</p>
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap">
                            <p>{{$stock->quantity}}</p>
                        </td>
                    </tr>
                @empty 
                    <tr>
                        <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">Nemate ništa u magacinu ili nema stavki sa unetom pretragom.</td>
                    </tr>
                @endforelse
                </tbody>
                {{ $stocks->links('pagination.custom-pagination') }}
        </table>
    </div> 
</div>
</div>