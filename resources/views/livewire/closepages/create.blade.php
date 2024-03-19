<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Close a Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <label for="url_page">Url Page</label>
                        <input wire:model="url_page" type="text" class="form-control" id="url_page"
                            placeholder="Type or Paste UrlPage to Close">
                        @error('url_page')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="url_waitlist">Url WaitList</label>
                        <input wire:model="url_waitlist" type="text" class="form-control" id="url_waitlist"
                            placeholder="Type or Paste WaitList">
                        @error('url_waitlist')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="close_at">Close At</label>
                            <input wire:model="close_at" type="text" class="form-control datetimepicker"
                                id="close_at" placeholder="Choose time to close the page">
                            @error('close_at')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="timezone">Timezone</label>
                            <select wire:model="timezone" class="form-control">
                                <option value="0">Choose...</option>
                                <option value="CT - America/Chicago">CT - America/Chicago</option>
                                <option value="PT - America/Los_Angeles">PT - America/Los_Angeles</option>
                                <option value="ET - America/New_York">ET - America/New_York</option>
                            </select>    
                            @error('timezone')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-dark close-btn" data-dismiss="modal"><i
                        class="fa-solid fa-circle-xmark mr-2"></i>Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-sm btn-info close-modal">Save <i
                        class="fa fa-sd-card ml-2"></i></button>
            </div>
        </div>
    </div>
</div>