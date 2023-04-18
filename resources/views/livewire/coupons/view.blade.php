<div>

    <div class="shadow-sm bg-white rounded-lg pt-3">
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

            <div class="form-group col-sm-5">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark">Search<i class="fas fa-magnifying-glass ml-2"></i></div>
                    </div>
                    <input type="text" wire:model="keyWord" class="form-control" placeholder="Type to search">
                </div>
            </div>

            <div class="form-group col-sm-3">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark">Sort by<i class="fas fa-filter ml-2"></i></div>
                    </div>
                    <select class="form-control" wire:model="list">
                        <option value="all" selected>All</option>
                        <option value="available">Availables</option>
                        <option value="not_ava">Not availables</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-sm-2 text-left">
                @include('livewire.coupons.create')
                @include('livewire.coupons.update')
                <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
                    New Coupon <i class="fa fa-ticket ml-2"></i>
                </div>
            </div>
        </div><!-- row -->


        @if (session()->has('message'))
            <div class="row d-flex justify-content-center">
                <div wire:poll.5s class="btn btn-sm btn-info">
                    {{ session('message') }}
                </div>
            </div>
        @endif




        <div class="table-responsive mt-2">
            <div class="row">
                <div class="col-sm-12">

                    @if (count($coupons))

                        <table class="table table-sm">
                            <thead class="bg-dark text-sm">
                                <tr class="align-middle">
                                    <th class="align-middle">
                                        <!-- align-middle -->
                                        ID
                                        @if ($sort == 'id')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt fa-xs"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt fa-xs"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort fa-xs"></i>
                                        @endif
                                    </th>
                                    <th class="align-middle" wire:click="order('name')">
                                        COUPON
                                        @if ($sort == 'name')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right fa-xs"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right fa-xs"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right fa-xs"></i>
                                        @endif

                                    </th>
                                    <th scope="col" class=" ">
                                        ACTIVE
                                    </th>
                                    <th scope="col" class=" " wire:click="">
                                        USED
                                    </th>
                                    <th class="align-middle" wire:click="order('limit')">
                                        LIMIT
                                        @if ($sort == 'limit')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right fa-xs"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right fa-xs"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right fa-xs"></i>
                                        @endif
                                    </th>
                                    <th scope="col" class=" " wire:click="order('description')">
                                        DESCRIPTION
                                        @if ($sort == 'description')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right fa-xs"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right fa-xs"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right fa-xs"></i>
                                        @endif
                                    </th>
                                    <th scope="col" class=" " wire:click="order('discount')">
                                        DISCOUNT
                                        @if ($sort == 'discount')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right fa-xs"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right fa-xs"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right fa-xs"></i>
                                        @endif
                                    </th>
                                    <th scope="col" class="" wire:click="order('available_until')">
                                        AVAILABLE UNTIL
                                        @if ($sort == 'available_until')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right fa-xs"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right fa-xs"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right fa-xs"></i>
                                        @endif

                                    </th>
                                    <th scope="col">
                                        ACTIONS
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $coupon->id }}</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $coupon->name }}</div>
                                        </td>

                                        <td class="whitespace-nowrap">
                                            <div class="text-sm d-flex justify-content-center">
                                                @if ($coupon->actived)
                                                    <i class="fas fa-circle-check" style="color:green"></i>
                                                @else
                                                    <i class="fas fa-circle-xmark" style="color:red"></i>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">#used</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $coupon->limit }}</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $coupon->description }}</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $coupon->discount }}</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $coupon->available_until }}</div>
                                        </td>

                                        <td class="d-flex justify-content-around">
                                            <div class="item">
                                                <a class="btn btn-sm btn-dark">
                                                    <i class="fas fa-file fa-xs"></i>
                                                </a>
                                            </div>
                                            <div class="item">
                                                {{-- @livewire('coupons.edit-coupon', ['coupon' => $coupon], key($coupon->id)) --}}
                                                <a data-toggle="modal" data-target="#updateModal"
                                                    class="btn btn-sm btn-info"
                                                    wire:click="edit({{ $coupon->id }})"><i
                                                        class="fa fa-pen fa-xs"></i>
                                                </a>
                                            </div>
                                            <div class="item">
                                                <a class="btn btn-sm btn-danger"
                                                    wire:click="$emit('deleteCoupon', {{ $coupon->id }})">
                                                    <i class="fas fa-trash fa-xs"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        @if ($coupons->hasPages())
                            <div class="px-6 py-3">
                                {{ $coupons->links() }}
                            </div>
                        @endif
                    @else
                        <div class="px-6 py-4">No matching records</div>
                    @endif
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- responsive -->

    </div> <!-- d-flex -->

</div> <!-- template -->


@section('plugins.Sweetalert2', true)

@push('js')
    <script>
        Livewire.on('deleteCoupon', couponId => {
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
                    Livewire.emitTo('coupons', 'delete', couponId);

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
