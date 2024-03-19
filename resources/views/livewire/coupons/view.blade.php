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

            <div class="form-group col-sm-2 mx-0 px-0">
                @include('livewire.coupons.create')
                @include('livewire.coupons.update')
                @include('livewire.coupons.detail')
                @include('livewire.coupons.import')
                @can('coupons.create')
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                            data-target="#createDataModal">
                            New Coupon <i class="fa fa-ticket ml-2"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <a data-toggle="modal" data-target="#importModal" class="text-white text-sm"
                            style="cursor:pointer;">
                            <ul class="dropdown-menu text-center bg-info py-1" role="menu">
                                <li>
                                    Bulk Import<i class="fa fa-file-excel ml-2"></i>
                                </li>
                            </ul>
                        </a>
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




        <div class="table-responsive mt-2">
            <div class="row">
                <div class="col-sm-12">

                    @if (count($coupons))

                        <table class="table table-sm">
                            <thead class="bg-dark text-sm">
                                <tr>
                                    <th class="align-middle" wire:click="order('id')">
                                        ID
                                    </th>
                                    <th class="align-middle" wire:click="order('name')">
                                        <div class="d-flex align-items-center">
                                            COUPON
                                            @if ($sort == 'name')
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
                                        ACTIVE
                                    </th>
                                    <th class="align-middle" wire:click="order('times_used')">

                                        <div class="d-flex align-items-center">
                                            USED
                                            @if ($sort == 'times_used')
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
                                    <th class="align-middle" wire:click="order('limit')">
                                        <div class="d-flex align-items-center">
                                            LIMIT
                                            @if ($sort == 'limit')
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
                                    <th class="align-middle" wire:click="order('description')">
                                        <div class="d-flex align-items-center">
                                            DESCRIPTION
                                            @if ($sort == 'description')
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
                                    <th class="align-middle" wire:click="order('discount')">
                                        <div class="d-flex align-items-center">
                                            DISCOUNT
                                            @if ($sort == 'discount')
                                                @if ($direction == 'asc')
                                                    <i class="fas fa-sort-alpha-up-alt fa-xs ml-2 ilink"></i>
                                                @else
                                                    <i class="fas fa-sort-alpha-down-alt fa-xs ml-2 ilink"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort float-right fa-xs ml-2 ilink"></i>
                                            @endif
                                        </div>
                                    </th>
                                    <th class="align-middle" wire:click="order('available_until')">
                                        <div class="d-flex align-items-center">
                                            AVAILABLE UNTIL
                                            @if ($sort == 'available_until')
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
                                @foreach ($coupons as $coupon)
                                    @php
                                        $consecutive = ($coupons->currentPage() - 1) * $coupons->perPage() + $loop->index + 1;
                                    @endphp
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $consecutive }}</div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">{{ $coupon->name }}</div>
                                        </td>

                                        <td class="whitespace-nowrap">
                                            <div class="text-sm d-flex justify-content-center align-items-center"
                                                style="height: 30px;">
                                                @if ($coupon->actived)
                                                    <i class="fas fa-circle-check" style="color:green;"
                                                        wire:click="$emit('changeStatuJuan', {{ $coupon->id }} , 'disable')"></i>
                                                @else
                                                    <i class="fas fa-circle-xmark" style="color:red;"
                                                        wire:click="$emit('changeStatuJuan', {{ $coupon->id }} , 'enable')"></i>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="text-sm">
                                                @if ($coupon->times_used)
                                                    <a data-toggle="modal" data-target="#detailModal"
                                                        wire:click="couponDetail({{ $coupon }})"
                                                        style="cursor:pointer;">
                                                        {{ number_format($coupon->times_used, 0) }}
                                                    </a>
                                                @else
                                                    0
                                                @endif
                                            </div>
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
                                            @can('coupons.edit')
                                                <div class="item mr-1">
                                                    {{-- @livewire('coupons.edit-coupon', ['coupon' => $coupon], key($coupon->id)) --}}
                                                    <a data-toggle="modal" data-target="#updateModal"
                                                        class="btn btn-sm btn-info"
                                                        wire:click="edit({{ $coupon }})"><i
                                                            class="fa fa-pen fa-xs"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('coupons.destroy')
                                                <div class="item">
                                                    @if ($coupon->deleted)
                                                        <a class="btn btn-sm btn-dark"
                                                            wire:click="$emit('changeStatu', {{ $coupon->id }} , 'restore')">
                                                            <i class="fas fa-circle-check fa-xs"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-danger"
                                                            wire:click="$emit('deleteCoupon', {{ $coupon->id }})">
                                                            <i class="fas fa-trash fa-xs"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                        @if ($coupons->hasPages())
                            <div class="mx-2 px-2 py-2">
                                {{ $coupons->links() }}
                            </div>
                        @endif
                    @else
                        <div class="d-flex justify-content-center mb-3">There are not Records</div>
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
                title: 'Are you sure you want to deactivate this Coupon ?',
                text: "If you deactivate the coupon, it cannot be used at Funnels",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('coupons', 'delete', couponId);
                    Swal.fire(
                        'Deactivated!',
                        'Coupon has been deactivated.',
                        'success'
                    )
                }
            })
        }); // deleteCoupon


        Livewire.on('changeStatu', (couponId, action) => {
            Swal.fire({
                title: `Are you sure you want to ${action} this Coupon ?`,
                showCancelButton: true,
                confirmButtonText: `Yes, ${action}`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('coupons', 'changeStatus', couponId, action);
                }
            })
        }); // changeStatus

        Livewire.on('closeModal', function() {
            $('#createDataModal').modal('hide');
        });

        Livewire.on('closeCouponDetail', function() {
            $('#detailModal').modal('hide');
        });

        Livewire.on('closeCouponImport', function() {
            $('#importModal').modal('hide');
            $('#excel_file').val('');
        });
    </script>
@endpush

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .ilink {
            cursor: pointer;
        }

        /* cupon_details modal */
        .table-wrapper {
            max-height: 400px;
            overflow-y: auto;
        }

        .table-wrapper table {
            width: 100%;
        }

        .table-wrapper thead {
            position: sticky;
            top: 0;
            background-color: #343a40;
            color: #fff;
        }
    </style>
@endpush
