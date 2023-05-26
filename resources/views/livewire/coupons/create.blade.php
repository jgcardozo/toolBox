<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create Coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Coupon</label>
                            <input wire:model="name" type="text" class="form-control" id="name"
                                placeholder="Name">
                            @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="discount">Discount (usd)</label>
                            <input wire:model="discount" type="text" class="form-control" id="discount"
                                placeholder="Discount">
                            @error('discount')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="limit">Limit</label>
                            <input wire:model="limit" type="text" class="form-control" id="limit"
                                placeholder="Limit">
                            @error('limit')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="available_until">Available Until</label>
                            <input wire:model="available_until" type="text" class="form-control datetimepicker" id="available_until"
                                placeholder="Available Until">
                            @error('available_until')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group ">
                        <label for="description">Description</label>
                        <textarea wire:model="description" class="form-control" id="description"
                            placeholder="Description" rows="3"></textarea>
                        @error('description')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-dark close-btn" data-dismiss="modal"><i class="fas fa-solid fa-xmark-circle mr-2"></i>Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-sm btn-info close-modal" >Save <i class="fa fa-sd-card ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
