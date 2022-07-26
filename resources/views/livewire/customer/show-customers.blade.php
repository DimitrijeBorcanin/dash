<div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <a href="{{route('customers.create')}}" class="flex cursor-pointer items-center hover:text-gray-500 px-3 md:px-0">
            <i class="fas fa-plus-square text-4xl pr-3"></i>
            <h2 class="text-2xl">
                Dodajte novog kupca
            </h2>
        </a>

        <x-jet-section-border />
    
        <div class="w-full mb-3 px-3 md:px-0">
            <x-jet-label for="search" value="Pretraga" />
            <x-jet-input id="search" type="text" class="mt-1 block w-full md:w-1/4" wire:model="filter.search" />
            <x-jet-input-error for="search" class="mt-2" />
        </div>
        <div class="overflow-x-auto w-full">
            <table class="min-w-full divide-y divide-gray-200 mb-3">
                <thead>
                    <tr>
                        <th class="w-1/5 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Ime</th>
                        <th class="w-1/5 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="w-1/5 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Instagram</th>
                        <th class="w-1/5 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Telefon</th>
                        <th class="w-1/5 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Adresa</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($customers as $customer)
                        <tr class="cursor-pointer hover:bg-gray-200" onclick="window.location = '{{ route('customer', ['customer' => $customer->id]) }}'">
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">{{$customer->name}}</td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">{{$customer->email ?? '-'}}</td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">{{$customer->instagram ?? '-'}}</td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">{{$customer->phone ?? '-'}}</td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">{{$customer->address_and_city ?? '-'}}</td>
                        </tr>
                    @empty 
                        <tr>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="5">Nemate nijednog kupca ili ne postoji kupac sa unetom pretragom.</td>
                        </tr>
                    @endforelse
                    </tbody>
            </table>
            {{ $customers->links('pagination.custom-pagination') }}
        </div>
    
    </div>
    
</div>