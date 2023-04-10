<div>
    <div class="alert alert-light" role="alert" style="background-color: #fff;">
        <div class="row">
            <div class="col-sm-6 form-group">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark">Search</div>
                    </div>
                    <input type="text" wire:model="search" class="form-control form-control-sm"
                        placeholder="Type to Search by Alias, ShortUrl or longUrl">
                </div>
            </div>

            <div class="col-sm-4 form-group">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark">Sort By</div>
                    </div>
                    <select class="form-control form-control-sm" wire:model="sort">
                        <option value="updated_at">Last updated</option>
                        <!-- <option value="user">User</option> -->
                        <option value="short_url">Domain</option>
                        <option value="long_url">Destination Url</option>
                    </select>
                    <select class="form-control form-control-sm" wire:model="direction">
                        <option value="desc">Desc</option>
                        <option value="asc">Asc</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2 form-group">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark">Display</div>
                    </div>
                    <select class="form-control" wire:model="cant">
                        @php
                            foreach (range(5, 50, 5) as $number) {
                                echo "<option value={$number}>{$number}</option>";
                            }
                        @endphp
                    </select>
                </div>
            </div>

        </div><!-- row-->
    </div>

    {{-- <div>sortby: @json($sort)</div> --}}

    @forelse ($links as $item)
        <div class="card my-2">
            <div class="row no-gutters">
                <div class="col-md-11">
                    <div class="card-body " style="color:blueviolet;">

                        <p class="card-text">
                        <div class="float-left">
                            <i class="fas fa-fw fa-link mr-2"></i>
                            <a href="{{ $item->short_url }}" target="_blank" class="alink">{{ $item->short_url }}</a>
                        </div>
                        <div class="float-right">
                            <i class="fas fa-fw fa-user mr-2"></i>{{ $item->user_name }}
                        </div>
                        </p>


                        <p class="card-text">
                            <i class="fas fa-fw fa-globe mr-2"></i>
                            <a href="{{ $item->long_url }}" target="_blank" class="alink">{{ $item->long_url }}</a>
                        </p>
                        <p class="card-text"><small style="color:blueviolet;">Last updated:
                                {{ $item->updated_at }}</small></p>
                    </div>
                </div>
                <div class="col-sm-1 my-auto text-center">
                    <div class="row ">
                        <div class="col-lg-12">
                            @can('links.edit')
                                <a href="{{ route('links.edit', $item) }}" class="btn btn-sm btn-info my-1">
                                    <i class="fa fa-pen"></i>
                                </a>
                            @endcan
                        </div>
                        <div class="col-lg-12">
                            @can('links.destroy')
                                <a class="btn btn-sm btn-danger my-1"
                                    wire:click="$emit('deleteLink', {{ $item }} )">
                                    <i class="fa fa-trash"></i>
                                </a>
                            @endcan
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-light my-2" role="alert" style="background-color: #fff;">
            There's any Link so far !
        </div>
    @endforelse

    @if ($links->count())
        <div class="row">
            <div class="mx-auto">
                {{ $links->links() }}
            </div>
        </div>
    @endif

</div>


@push('css')
    <style>
        .aalink {
            color:blueviolet;
        }
        .aalink:hover {
            color:blueviolet;
            font-weight: bold;
        }
    </style>
@endpush

{{--  https://github.com/jeroennoten/Laravel-AdminLTE/issues/777 --}}
{{-- https://www.youtube.com/watch?v=ABCs9dbSKg4&list=PLZ2ovOgdI-kWqCet33O0WezN14KShkwER&index=20 --}}

@section('plugins.Sweetalert2', true)

@push('js')
    <script>
        Livewire.on('deleteLink', linkId => {
            Swal.fire({
                title: 'Are you sure you want to delete this Redirect ?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('links', 'delete', linkId);

                    Swal.fire(
                        'Deleted!',
                        'Redirect has been deleted.',
                        'success'
                    )
                }
            })
        });
    </script>
@endpush
