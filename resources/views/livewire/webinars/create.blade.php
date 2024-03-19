<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">New Webinar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body scrollable-modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="time">Time (CT)</label>
                            <input wire:model="time" type="text" class="form-control datetimepicker" id="time"
                                placeholder="Time">
                            @error('time')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror                      
                        </div>
                        <div class="form-group col-md-3">
                            <label for="timeEnd">TimeEnd (CT)</label>
                            <input wire:model="timeEnd" type="text" class="form-control datetimepicker" id="timeEnd"
                                placeholder="Time End" >
                            @error('timeEnd')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror                         
                        </div>
                  {{--   </div>

                    <div class="row"> --}}

                        <div class="form-group col-sm-3">
                            <label for="value">Option Value</label>
                            <input wire:model="value" type="text" class="form-control" id="value"
                                placeholder="Option Value" oninput="this.value = this.value.replace(/\D/g, '')" >
                            @error('value')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="smsListId">SMS ListId</label>
                            <input wire:model="smsListId" type="text" class="form-control" id="smsListId"
                                placeholder="smsListId" oninput="this.value = this.value.replace(/\D/g, '')">
                            @error('smsListId')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group ">
                        <label for="smsText1">SMS Text1</label>
                        <textarea wire:model="smsText1" class="form-control no-resize" id="smsText1" placeholder="smsText1" rows="2"></textarea>
                        @error('smsText1')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="smsText2">SMS Text2</label>
                        <textarea wire:model="smsText2" class="form-control no-resize" id="smsText2" placeholder="smsText2" rows="2"></textarea>
                        @error('smsText2')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <label for="calendarTitle">Calendar Title</label>
                        <textarea wire:model="calendarTitle" class="form-control no-resize" placeholder="Calendar Title" id="calendarTitle"
                            rows="2"></textarea>
                        @error('calendarTitle')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="calendarDescription">Calendar Description</label>
                        <textarea wire:model="calendarDescription" class="form-control no-resize" placeholder="Calendar Description" id="calendarDescription"
                            rows="2"></textarea>
                        @error('calendarDescription')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-dark close-btn" data-dismiss="modal"><i
                        class="fas fa-solid fa-xmark-circle mr-2"></i>Close</button>
                <button wire:loading.attr="disabled" wire:target="store" type="button" wire:click.prevent="store()"
                    class="btn btn-sm btn-info disabled:opacity-50">Save <i class="fa fa-sd-card ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
