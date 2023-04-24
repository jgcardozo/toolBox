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
                    </select>{{ $list }} {{ $status }}
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
                                <tr>
                                    <th class="align-middle" wire:click="order('id')">
                                        <div class="d-flex align-items-center">
                                            ID
                                            @if ($sort == 'id')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt fa-xs ml-2"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt fa-xs ml-2"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort fa-xs ml-2"></i>
                                            @endif
                                        </div>
                                    </th>
                                    <th class="align-middle" wire:click="order('name')">
                                        <div class="d-flex align-items-center">
                                            COUPON
                                            @if ($sort == 'name')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt fa-xs ml-2"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt fa-xs ml-2"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort fa-xs ml-2"></i>
                                            @endif
                                        </div>
                                    </th>
                                    <th class="align-middle">
                                        ACTIVE
                                    </th>
                                    <th class="align-middle" wire:click="">
                                        USED
                                    </th>
                                    <th class="align-middle" wire:click="order('limit')">
                                        <div class="d-flex align-items-center">
                                            LIMIT
                                            @if ($sort == 'limit')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt fa-xs ml-2"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt fa-xs ml-2"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort fa-xs ml-2"></i>
                                            @endif
                                        </div>
                                    </th>
                                    <th class="align-middle" wire:click="order('description')">
                                        <div class="d-flex align-items-center">
                                            DESCRIPTION
                                            @if ($sort == 'description')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt fa-xs ml-2"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt fa-xs ml-2"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort fa-xs ml-2"></i>
                                            @endif
                                        </div>
                                    </th>
                                    <th class="align-middle" wire:click="order('discount')">
                                        <div class="d-flex align-items-center">
                                            DISCOUNT
                                            @if ($sort == 'discount')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt fa-xs ml-2"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt fa-xs ml-2"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right fa-xs ml-2"></i>
                                            @endif
                                        </div>
                                    </th>
                                    <th class="align-middle" wire:click="order('available_until')">
                                        <div class="d-flex align-items-center">
                                            AVAILABLE UNTIL
                                            @if ($sort == 'available_until')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt fa-xs ml-2"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt fa-xs ml-2"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort fa-xs ml-2"></i>
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
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $coupon->id }}</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $coupon->name }}</div>
                                        </td>

                                        <td class="whitespace-nowrap">
                                            <div class="text-sm d-flex justify-content-center align-items-center"
                                                style="height: 30px;">
                                                @if ($coupon->actived)
                                                    <i class="fas fa-circle-check" style="color:green; cursor:pointer"
                                                        wire:click="$emit('changeStatu', {{ $coupon->id }} , 'disable')"></i>
                                                @else
                                                    <i class="fas fa-circle-xmark" style="color:red; cursor:pointer"
                                                        wire:click="$emit('changeStatu', {{ $coupon->id }} , 'enable')"></i>
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

                                        <td class="d-flex justify-content-center">
                                            <div class="item">
                                                <a class="btn btn-sm btn-dark">
                                                    <i class="fas fa-file fa-xs"></i>
                                                </a>
                                            </div>
                                            <div class="item mx-1">
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
                        <div class="d-flex justify-content-center mb-3">There is not Records</div>
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
                //autoclose: true,
                minDate: 0,
                yearStart: 2020,
                yearEnd: 2040,
                onChangeDateTime: function(dp, $input) {
                    console.log($input.val());
                    Livewire.emitTo('coupons', 'untilChanged', $input.val());
                }
            });

        }); //jqReady
    </script>

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
        }); // deleteCoupon


        Livewire.on('changeStatu', (couponId, action) => {
            Swal.fire({
                title: `Are you sure you want to ${action} this Coupon ?`,
                //showDenyButton: true,
                //denyButtonText: `Disable Coupon`,
                showCancelButton: true,
                confirmButtonText: `Yes, ${action}`,      
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('coupons', 'changeStatus', couponId, action);  
                }
            })
        }); // changeStatus
    </script>
@endpush

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
