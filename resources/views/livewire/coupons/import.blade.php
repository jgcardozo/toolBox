<!-- Modal -->
<div wire:ignore.self class="modal fade" id="importModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Coupon: Bulk Import</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent="importFromExcel">
                    <div class="row">
                        <div class="form-group col-md-9">
                            <input type="file" class="form-control form-control-sm" wire:model="excel_file" id="excel_file">
                            @error('excel_file')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <button wire:loading.attr="disabled" wire:target="importFromExcel" type="submit"
                                class="btn btn-sm btn-success disabled:opacity-50">
                                Import<i class="fa fa-file-excel ml-2"></i>
                            </button>
                        </div>
                    </div> {{-- row --}}
                </form>
            </div><!-- modal-body -->

        </div>

    </div>
</div>
