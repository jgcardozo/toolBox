<div>

    <div class="shadow-sm bg-white rounded-lg pt-2">

        <div class="row mx-2">

            <div class="form-group col-sm-3">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark">Server</div>
                    </div>
                    <select class="form-control" wire:model="serverName">
                        <option value="0">Choose...</option>
                        <option value="hybridexpert.com">hybridexpert.com</option>
                        <option value="askmethod.com">askmethod.com</option>
                        <option value="bucket.io">bucket.io</option>
                        {{--  @foreach ($servers as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach --}}
                    </select>
                    <div class="input-group-append" wire:loading.flex wire:target="serverName">
                        <div class="input-group-text bg-dark">
                            <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group col-sm-3">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark">File</div>
                    </div>
                
                    <select class="form-control" wire:model="serverFileSelected"  @if(count($serverFiles)<=0) disabled @endif>
                        <option value="0">Choose...</option>
                        @foreach ($serverFiles as $file)
                            <option>{{ $file }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append" wire:loading.flex wire:target="serverFileSelected">
                        <div class="input-group-text bg-dark">
                            <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group col-sm-2 mx-0 px-0">
                @include('livewire.webinars.create')
                @include('livewire.webinars.update')
                @can('webinars.create')
                    <div class="btn-group">
                        <button type="button btn-sm" class="btn btn-sm btn-info" data-toggle="modal"
                            data-target="#createDataModal">
                            New Date <i class="fa fa-calendar-days ml-2"></i>
                        </button>
                    </div>
                @endcan
            </div>
        </div><!-- row -->


        @if (session()->has('message'))
            <div class="row d-flex justify-content-center">
                <div wire:poll.5s class="btn btn-sm btn-info">
                    {{ session('message') }}
                </div>
            </div>
        @endif




        <div class="table-responsive mt-0">
            <div class="row">
                <div class="col-sm-12">

                    @if (count($webinars))

                        <table class="table table-sm">
                            <thead class="bg-dark text-sm">
                                <tr>
                                    <th class="align-middle">
                                        #
                                    </th>
                                    <th class="align-middle" wire:click="order('time')">
                                        <div class="d-flex align-items-center">
                                            Date
                                        </div>
                                    </th>
                                    <th class="align-middle">
                                        Show
                                    </th>
                                    <th class="align-middle">
                                        Unavailable
                                    </th>
                                    <th class="align-middle" wire:click="order('value')">
                                        <div class="d-flex align-items-center">
                                            Value
                                        </div>
                                    </th>
                                    <th class="align-middle" wire:click="order('smsListId')">
                                        <div class="d-flex align-items-center">
                                            SmsListId
                                        </div>
                                    </th>
                                    <th class="align-middle" wire:click="order('smsText1')">
                                        <div class="d-flex align-items-center">
                                            SmsText-1
                                            @if ($sort == 'smsText1')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt fa-xs ml-2 ilink"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt fa-xs ml-2 ilink"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort fa-xs ml-2 ilink"></i>
                                            @endif
                                        </div>
                                    </th>

                                    <th class="align-middle">
                                        <div class="d-flex align-items-center">
                                            ACTIONS
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($webinars as $item)
                                    @php
                                        //$consecutive = ($webinars->currentPage() - 1) * $webinars->perPage() + $loop->index + 1;
                                    @endphp
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $loop->iteration }}</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $item->time }}</div>
                                        </td>

                                        <td class="whitespace-nowrap">
                                            <div class="text-sm d-flex justify-content-center align-items-center"
                                                style="height: 30px;">
                                                @if ($item->show)
                                                    <i class="fas fa-circle-check" style="color:green;"
                                                        wire:click="$emit('showChanged', {{ $item->show }} , 'disable')"></i>
                                                @else
                                                    <i class="fas fa-circle-xmark" style="color:red;"
                                                        wire:click="$emit('showChanged', {{ $item->show }} , 'enable')"></i>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap">
                                            <div class="text-sm d-flex justify-content-center align-items-center"
                                                style="height: 30px;">
                                                @if ($item->unavailable)
                                                    <i class="fas fa-circle-check" style="color:green;"
                                                        wire:click="$emit('unavailableChanged', {{ $item->show }} , 'disable')"></i>
                                                @else
                                                    <i class="fas fa-circle-xmark" style="color:red;"
                                                        wire:click="$emit('unavailableChanged', {{ $item->show }} , 'enable')"></i>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $item->value }}</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $item->smsListId }}</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $item->smsText1 }}</div>
                                        </td>

                                        {{--      <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $item->calendarTitle }}</div>
                                        </td> --}}



                                        <td class="d-flex justify-content-center">
                                            @can('webinars.edit')
                                                <div class="item mr-1">
                                                    <a data-toggle="modal" data-target="#updateModal"
                                                        class="btn btn-sm btn-info"
                                                        wire:click="edit('{{ $item->time }}')"><i
                                                            class="fa fa-pen fa-xs"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('webinars.destroy')
                                                <div class="item">
                                                    <a class="btn btn-sm btn-danger"
                                                        wire:click="$emit('deleteWebinar', '{{ $item->time }}')">
                                                        <i class="fas fa-trash fa-xs"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                        {{--    @if ($webinars->hasPages())
                            <div class="mx-2 px-2 py-2">
                                {{ $webinars->links() }}
                            </div>
                        @endif 
                    @else
                        <div class="d-flex justify-content-center mb-3">There are not Records</div> --}}
                    @endif
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- responsive -->

    </div> <!-- d-flex -->

</div> <!-- template -->





@section('plugins.Sweetalert2', true)

@push('js')
    {{-- https://xdsoft.net/jqplugins/datetimepicker/ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"
        integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {

            $(".datetimepicker").datetimepicker({
                format: 'Y-m-d H:i',
                minDate: 0,
                yearStart: 2020,
                yearEnd: 2040,
                onChangeDateTime: function(dp, $input) {
                    let inputChanged = $input[0].id + 'Changed';
                    if ($input.val()) {
                        console.log(inputChanged, $input.val());
                        Livewire.emitTo('webinars', inputChanged, $input.val().trim());
                    }
                }
            });

        }); //jqReady
    </script>

    <script>
        Livewire.on('deleteWebinar', webinarId => {
            Swal.fire({
                title: 'Are you sure you want to delete this Webinar ?',
                html: `If you <strong>delete</strong> this DateTime: <strong>${webinarId}</strong>, it cannot be used at Funnels`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                console.log('webinarId', webinarId);
                if (result.isConfirmed) {
                    Livewire.emitTo('webinars', 'delete', webinarId);
                    Swal.fire(
                        'Deleted !',
                        'Webinar Date has been deleted.',
                        'success'
                    )
                }
            })
        }); // deleteWebinar
    </script>
@endpush


@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .scrollable-modal-body {
            max-height: 400px;
            overflow-y: auto;
        }

        /* for textarea in webinar.create.blade*/
        .no-resize {
            resize: none;
        }
    </style>
@endpush
