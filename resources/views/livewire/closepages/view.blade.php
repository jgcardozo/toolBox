<div>

    <div class="shadow-sm bg-white rounded-lg pt-3 mb-3">
        <!-- d-flex justify-content-around  -->
        <div class="row mx-2">
            <div class="form-group col-sm-2">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend mr-2 my-auto">
                        <div class="">Show</div>
                    </div>
                    <select class="form-control rounded" wire:model="cant">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <div class="input-group-append ml-2 my-auto">
                        entries
                    </div>
                </div>
            </div>

            <div class="form-group col-sm-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark">Search<i class="fas fa-magnifying-glass ml-2"></i></div>
                    </div>
                    <input type="text" wire:model="keyWord" class="form-control" placeholder="Type to search">
                </div>
            </div>

            <div class="form-group col-sm-4">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark">Sort By<i class="fa-solid fa-sort ml-2"></i></div>
                    </div>
                    <select class="form-control form-control-sm" wire:model="sort">
                        <option value="close_at">close time</option>
                        <option value="url_page">Page to Close</option>
                        <option value="url_waitlist">Waitlist</option>
                    </select>
                    <select class="form-control form-control-sm" wire:model="direction">
                        <option value="desc">Desc</option>
                        <option value="asc">Asc</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-sm-2 text-left">
                @include('livewire.closepages.create')
                @include('livewire.closepages.update')
                @can('closepages.create')
                    <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
                        Add Page to Close <i class="fa fa-circle-plus ml-2"></i>
                    </div>
                @endcan
            </div>
        </div><!-- row -->


        @if (session()->has('message'))
            <div class="row d-flex justify-content-center">
                <div wire:poll.5s class="btn btn-sm btn-info m-2">
                    {{ session('message') }}
                </div>
            </div>
        @endif
    </div> <!-- d-flex -->




    @forelse ($pages as $item)
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-9 bg-infoo alink">
                        <p class="mb-1">
                            <i class="fas fa-fw fa-globe mr-2"></i>
                            <a href="{{ $item->url_page }}" target="_blank" class="alink">{{ $item->url_page }}</a>
                        </p>
                        <p class="mb-1">
                            <i class="fa-solid fa-right-from-bracket ml-1 mr-2"></i>
                            <a href="{{ $item->url_waitlist }}" target="_blank"
                                class="alink">{{ $item->url_waitlist }}</a>
                        </p>
                        <p class="mb-1">
                            <i class="fas fa-solid fa-hourglass-end ml-1 mr-2"></i>
                            {{ $item->close_at }} [{{ $item->timezone }}] 
                            @if ($item->done)
                                <span class="badge badge-info">Page Closed</span>
                            @else
                                <span class="badge badge-warning">Scheduled</span> 
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-2 my-auto py-2 bg-secondaryy alink">
                        <i class="fas fa-fw fa-user mr-2"></i>{{ $item->user_name }}
                    </div>
                    <div class="col-lg-1 my-auto py-2 bg-warningg d-flex flex-row justify-content-center"> 
                            @can('closepages.edit')
                                <div class="m-1">
                                    <a data-toggle="modal" data-target="#updateModal" class="btn btn-sm btn-info"
                                        wire:click="edit({{ $item }})">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                </div>
                            @endcan
                            @can('closepages.destroy')
                                <div class="m-1">
                                    <a class="btn btn-sm btn-danger" wire:click="$emit('deletePage', {{ $item->id }} )">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            @endcan
                    </div>
                </div> <!-- row -->
            </div><!-- card-body -->
        </div> <!-- card -->

    @empty
        <div class="alert alert-light my-2" role="alert" style="background-color: #fff;">
            No Pages to Close, so far !
        </div>
    @endforelse

    {{--     @if ($pages->count())
        <div class="mt-3">
            {{ $pages->links() }}
        </div>
    @endif --}}

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
                //autoclose: true,
                minDate: 0,
                yearStart: 2020,
                yearEnd: 2040,
                //timepicker:true,
                onChangeDateTime: function(dp, $input) {
                    console.log($input.val());
                    Livewire.emitTo('close-pages', 'closetimeChanged', $input.val());
                }
            });

        }); //jqReady
    </script>


    <script>
        Livewire.on('deletePage', pageId => {
            Swal.fire({
                title: 'Are you sure you want to delete this PageToClose ?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('close-pages', 'delete', pageId);
                    Swal.fire(
                        'Deleted!',
                        'PageToClose has been deleted.',
                        'success'
                    )
                }
            })
        }); // deletePage
    </script>
@endpush

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
