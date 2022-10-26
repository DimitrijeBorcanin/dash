<div>
    <x-jet-form-section submit="updateProduct">
        <x-slot name="title">
            
        </x-slot>
    
        <x-slot name="description">
            
        </x-slot>
    
        <x-slot name="form">
            <div class="col-span-6 grid grid-cols-6 gap-6">
                <!-- Type -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["value" => $state["type"], "isSelect" => $this->checkList("type", $state["type"]), "list" => $lists["type"], "model" => "state.type", "title" => "Vrsta proizvoda", "inputId" => "type", "state" => "type"])
                    <x-jet-input-error for="type" class="mt-2" />
                </div>  
                <!-- Code -->
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="code" value="Kod" />
                    <x-jet-input id="code" type="text" class="mt-1 block w-full" wire:model.defer="state.code" autocomplete="code" />
                    <x-jet-input-error for="code" class="mt-2" />
                </div>
            </div>
            <div class="col-span-6 my-5">
            </div>
            <div class="col-span-6 grid grid-cols-6 gap-6">
                <!-- Color -->
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="color" value="Boja konstrukcije" />
                    <x-jet-input id="color" type="text" class="mt-1 block w-full" wire:model.defer="state.color" autocomplete="color" />
                    <x-jet-input-error for="color" class="mt-2" />
                </div>
                <!-- Height -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["value" => $state["height"], "isSelect" => $this->checkList("height", $state["height"]), "list" => $lists["height"], "model" => "state.height", "title" => "Visina", "inputId" => "height", "state" => "height"])
                    <x-jet-input-error for="height" class="mt-2" />
                </div>
                <!-- Top type -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["value" => $state["top_type"], "isSelect" => $this->checkList("top_type", $state["top_type"]), "list" => $lists["top_type"], "model" => "state.top_type", "title" => "Vrsta ploče", "inputId" => "top_type", "state" => "top_type"])
                    <x-jet-input-error for="top_type" class="mt-2" />
                </div>
                <!-- Top name -->
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="top_name" value="Naziv ploče" />
                    <x-jet-input id="top_name" type="text" class="mt-1 block w-full" wire:model.defer="state.top_name" autocomplete="top_name" />
                    <x-jet-input-error for="top_name" class="mt-2" />
                </div>
                <!-- Dimensions -->
                <div class="col-span-6 lg:col-span-2">
                    <x-jet-label for="dimensions" value="Dimenzija ploče" />
                    <x-jet-input id="dimensions" type="text" class="mt-1 block w-full" wire:model.defer="state.dimensions" autocomplete="dimensions" />
                    <x-jet-input-error for="dimensions" class="mt-2" />
                </div>
                <!-- Top shape -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["value" => $state["top_shape"], "isSelect" => $this->checkList("top_shape", $state["top_shape"]), "list" => $lists["top_shape"], "model" => "state.top_shape", "title" => "Oblik ploče", "inputId" => "top_shape", "state" => "top_shape"])
                    <x-jet-input-error for="top_shape" class="mt-2" />
                </div>
                <!-- Edge type -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["value" => $state["edge_type"], "isSelect" => $this->checkList("edge_type", $state["edge_type"]), "list" => $lists["edge_type"], "model" => "state.edge_type", "title" => "Obrada ivice", "inputId" => "edge_type", "state" => "edge_type"])
                    <x-jet-input-error for="edge_type" class="mt-2" />
                </div>
                <!-- Protection  -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["value" => $state["protection"], "isSelect" => $this->checkList("protection", $state["protection"]), "list" => $lists["protection"], "model" => "state.protection", "title" => "Zaštita", "inputId" => "protection", "state" => "protection"])
                    <x-jet-input-error for="protection" class="mt-2" />
                </div>
                <!-- Quantity -->
                <div class="col-span-6 lg:col-span-2">
                    @livewire('forms.select-other', ["value" => $state["quantity"], "isSelect" => $this->checkList("quantity", $state["quantity"]), "list" => $lists["quantity"], "model" => "state.quantity", "title" => "Količina", "inputId" => "quantity", "state" => "quantity"])
                    <x-jet-input-error for="quantity" class="mt-2" />
                </div>
            </div>
            <div class="col-span-6 my-5">
            </div>
            <div class="col-span-6 grid grid-cols-11 gap-6">
                <!-- Currency -->
                <div class="col-span-11 lg:col-span-2">
                    @livewire('forms.select-other', ["value" => $state["currency"], "isSelect" => $this->checkList("currency", $state["currency"]), "list" => $lists["currency"], "model" => "state.currency", "title" => "Moneta", "inputId" => "currency", "state" => "currency"])
                    <x-jet-input-error for="currency" class="mt-2" />
                </div>
                <!-- Transport -->
                <div class="col-span-11 lg:col-span-3">
                    <x-jet-label for="transport" value="Prevoz" />
                    <x-jet-input id="transport" type="text" class="mt-1 block w-full" wire:model.defer="state.transport" autocomplete="transport" />
                    <x-jet-input-error for="transport" class="mt-2" />
                </div>
                <!-- Transport Customer -->
                <div class="col-span-11 lg:col-span-3">
                    <x-jet-label for="transport_customer" value="Prevoz kupac" />
                    <x-jet-input id="transport_customer" type="text" class="mt-1 block w-full" wire:model.defer="state.transport_customer" autocomplete="transport_customer" />
                    <x-jet-input-error for="transport_customer" class="mt-2" />
                </div>
                <!-- Price -->
                <div class="col-span-11 lg:col-span-3">
                    <x-jet-label for="price" value="Cena" />
                    <x-jet-input id="price" type="text" class="mt-1 block w-full" wire:model.defer="state.price" autocomplete="price" />
                    <x-jet-input-error for="price" class="mt-2" />
                </div>
                <!-- Deposit -->
                <div class="col-span-11 lg:col-span-3">
                    <x-jet-label for="deposit" value="Kapara" />
                    <x-jet-input id="deposit" type="text" class="mt-1 block w-full" wire:model.defer="state.deposit" autocomplete="deposit" />
                    <x-jet-input-error for="deposit" class="mt-2" />
                </div>
                <!-- Linked -->
                <div class="col-span-11 lg:col-span-3">
                    <x-jet-label for="linked" value="Vezano za" />
                    <x-jet-input id="linked" type="text" class="mt-1 block w-full" wire:model.defer="state.linked" autocomplete="linked" />
                    <x-jet-input-error for="linked" class="mt-2" />
                </div>
            </div>
            
        </x-slot>
    
        <x-slot name="actions">
            <x-jet-secondary-button class="mr-3" wire:click="cancelUpdate()">
                Otkaži
            </x-jet-secondary-button>

            <x-jet-action-message class="mr-3" on="saved">
                Sačuvano
            </x-jet-action-message>
    
            <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                Sačuvaj
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>