<div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        @include('livewire.user.user-modal')

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
                        <th class="w-1/4 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Ime</th>
                        <th class="w-1/4 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="w-1/4 px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Uloga</th>
                        <th class="w-1/4 px-6 py-3 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Brisanje</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">{{$user->name}}</td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">{{$user->email}}</td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                <select wire:change="updateRole({{$user->id}}, $event.target.value)" class="rounded-md pr-5">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif>{{$role->name}}&nbsp;&nbsp;</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap text-right">
                                <x-jet-button wire:click="showFormModal({{$user}})"><i class="fa-solid fa-pen"></i></x-jet-button>
                                <x-jet-danger-button wire:click="showDeleteModal({{$user}})"><i class="fa-solid fa-trash"></i></x-jet-danger-button>
                            </td>
                        </tr>
                    @empty 
                        <tr>
                            <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">Nemate nijednog zaposlenog ili ne postoji zaposleni sa unetom pretragom.</td>
                        </tr>
                    @endforelse
                    </tbody>
            </table>
            {{ $users->links('pagination.custom-pagination') }}
        </div>
    
    </div>
    
    @include('livewire.user.user-delete-modal')
</div>