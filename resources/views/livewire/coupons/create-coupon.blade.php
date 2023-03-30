<div>

    <x-button class="ml-3" wire:click="$set('open', true)">
        Create Coupon
        <x-slot name="icono">
            <i class="fas fa-ticket ml-3"></i>
        </x-slot>
    </x-button>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            New Coupon
        </x-slot>

        <x-slot name="content">

            <div class="mb-4 flex space-x-3">
                <div class="item w-full">
                    <x-jet-label value="Coupon" />
                    <x-jet-input type="text" class="w-full" wire:model="name" />
                    <x-jet-input-error for="name" />
                </div>
                <div class="item w-full">
                    <x-jet-label value="Discount" />
                    <x-jet-input type="text" class="w-full numero" wire:model.defer="discount" />
                    <x-jet-input-error for="discount" />
                </div>
            </div>

            <div class="mb-4 flex space-x-3">
                <div class="item w-full">
                    <x-jet-label value="Limit" />
                    <x-jet-input type="text" class="w-full numero" wire:model.defer="limit" />
                    <x-jet-input-error for="limit" />
                </div>
                <div class="item w-full">
                    <x-jet-label value="Available Until" />
                    <x-jet-input type="text" class="w-full datetime" wire:model.defer="available_until" />
                    <x-jet-input-error for="available_until" />
                    {{ $available_until }}
                    <!-- poner espacio pq sino dira vacio-->
                </div>
            </div>


            <div class="mb-4">
                <x-jet-label value="Description" />
                <textarea class="form-control w-full" rows="4" wire:model.defer="description"></textarea>
                <x-jet-input-error for="description" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)" class="mr-2">
                Cancel
            </x-jet-secondary-button>
            <x-primary-button wire:click="create" wire:target="create" wire:loading.attr="disabled"
                class="disabled:opacity-25">
                Create Coupon
                {{-- <span wire:loading wire:target="create" >Processing...</span> --}}
            </x-primary-button>

        </x-slot>

    </x-jet-dialog-modal>



</div>
