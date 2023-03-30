<div >
    



     @if (count($coupons))
                <table class="table table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col"
                                class=" "
                                wire:click="order('id')">
                                id
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class=" "
                                wire:click="order('name')">
                                Coupon
                                @if ($sort == 'name')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif

                            </th>
                            <th scope="col"
                                class=" ">
                                Active
                            </th>
                            <th scope="col"
                                class=" "
                                wire:click="">
                                used
                            </th>
                            <th scope="col"
                                class=" "
                                wire:click="order('limit')">
                                Limit
                                @if ($sort == 'limit')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class=" "
                                wire:click="order('description')">
                                Description
                                @if ($sort == 'description')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class=" "
                                wire:click="order('discount')">
                                Discount
                                @if ($sort == 'discount')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class=" "
                                wire:click="order('available_until')">
                                Available Until
                                @if ($sort == 'available_until')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class=" "
                                wire:click="order('created_at')">
                                Created
                                @if ($sort == 'created_at')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th scope="col" class="cursor-pointer text-left text-xs font-medium uppercase ">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $coupon->id }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $coupon->name }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if ($coupon->actived)
                                            <i class="fa-solid fa-circle-check" style="color:green"></i>
                                        @else
                                            <i class="fa-solid fa-circle-xmark" style="color:red"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">#used</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $coupon->limit }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $coupon->description }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $coupon->discount }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $coupon->available_until }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $coupon->created_at }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap flex justify-center space-x-2">
                                    <div class="item">
                                        {{-- @livewire('edit-coupon', ['coupon' => $coupon], key($coupon->id)) --}}
                                        {{-- <a class="btn btn-green" wire:click="edit({{$coupon->edit}})">
                                            <i class="fas fa-edit"></i>
                                        </a> --}}
                                    </div>
                                    <div class="item">
                                        <a class="btn btn-red" wire:click="$emit('deleteCoupon', {{ $coupon->id }})">
                                            <i class="fas fa-trash"></i>
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


</div>