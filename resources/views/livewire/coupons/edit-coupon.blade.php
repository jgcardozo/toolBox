<div>
    <a class="btn btn-blue" wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name='title'>
            Edit Coupon
        </x-slot>

        <x-slot name='content'>
            <div class="mb-4 flex space-x-3">
                <div class="item w-full">
                    <x-jet-label value="Coupon" />
                    <x-jet-input type="text" class="w-full" wire:model.defer="coupon.name" readonly/>
                    <x-jet-input-error for="coupon.name" />
                </div>
                <div class="item w-full">
                    <x-jet-label value="Discount" />
                    <x-jet-input type="text" class="w-full numero" wire:model.defer="coupon.discount" />
                    <x-jet-input-error for="coupon.discount" />
                </div>
            </div>

            <div class="mb-4 flex space-x-3">
                <div class="item w-full">
                    <x-jet-label value="Limit" />
                    <x-jet-input type="text" class="w-full numero" wire:model.defer="coupon.limit" />
                    <x-jet-input-error for="coupon.limit" />
                </div>
                <div class="item w-full">
                    <x-jet-label value="Available Until" />
                    <x-jet-input type="text" class="w-full datetime" wire:model.defer="coupon.available_until" />
                    <x-jet-input-error for="coupon.available_until" />
                    <!-- poner espacio pq sino dira vacio-->
                </div>
            </div>


            <div class="mb-4">
                <x-jet-label value="Description" />
                <textarea class="form-control w-full" rows="4" wire:model.defer="coupon.description"></textarea>
                <x-jet-input-error for="coupon.description" />
            </div>

        </x-slot>





        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open', false)" class="mr-2">
                Cancel
            </x-jet-secondary-button>
            <x-primary-button wire:click="update" wire:target="update" wire:loading.attr="disabled"
                class="disabled:opacity-25">
                Update Coupon
                {{-- <span wire:loading wire:target="create" >Processing...</span> --}}
            </x-primary-button>

        </x-slot>

    </x-jet-dialog-modal>

</div>
