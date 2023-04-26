<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Edit Coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="selected_id">

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="name"></label>
                            <input wire:model="name" type="text" class="form-control" id="name"
                                placeholder="Name">
                            @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="discount"></label>
                            <input wire:model="discount" type="text" class="form-control" id="discount"
                                placeholder="Discount">
                            @error('discount')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="limit"></label>
                            <input wire:model="limit" type="text" class="form-control" id="limit"
                                placeholder="Limit">
                            @error('limit')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="available_until"></label>
                            <input wire:model="available_until" type="text" class="form-control datetimepicker"
                                id="available_until" placeholder="Available Until">
                            @error('available_until')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="description"></label>
                        <textarea wire:model="description" class="form-control" id="description" placeholder="Description" rows="3"></textarea>
                        @error('description')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{--       <div class="form-group">
                        <label for="actived"></label>
                        <input wire:model="actived" type="text" class="form-control" id="actived"
                            placeholder="Actived">
                        @error('actived')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deleted"></label>
                        <input wire:model="deleted" type="text" class="form-control" id="deleted"
                            placeholder="Deleted">
                        @error('deleted')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-dark" data-dismiss="modal"><i
                        class="fas fa-solid fa-backward mr-2"></i>Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save<i
                        class="fa fa-sd-card ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
