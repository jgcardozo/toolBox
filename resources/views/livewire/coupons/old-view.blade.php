<div wire:init="loadCoupons">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-wraper>

            <div class="px-6 py-4 flex rounded-md shadow-sm">
                <!-- rounded-md shadow-sm -->
                <div class="item flex items-center">
                    <span>Show</span>
                    <select class="form-control mx-2" wire:model="cant">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entries</span>
                </div>

               
                    <span
                        class="ml-3 inline-flex items-center px-6 rounded-l-md border border-r-0 border-gray-500 bg-gray-800 text-gray-100 text-sm">
                        Search <i class="fas fa-magnifying-glass ml-3"></i>
                    </span>
                    
                    <input type="text" wire:model="search"
                      class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
              

                
                    <span class="ml-3 inline-flex items-center px-6 rounded-l-md border border-r-0 border-gray-500 bg-gray-800 text-gray-100 text-sm">
                        Filter <i class="fas fa-filter ml-3"></i></span>
                    <select class="form-control" wire:model="list">
                        <option value="all" selected>All</option>
                        <option value="available">Availables</option>
                        <option value="not_ava">Not availables</option>
                    </select>
                    
               

                <div class="item">
                    @livewire('create-coupon')
                </div>      
            </div>



            @if (count($coupons))
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th scope="col"
                                class="w-24 px-2 py-2 cursor-pointer text-left text-xs font-medium uppercase "
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
                                class="w-24 px-2 py-2 cursor-pointer text-left text-xs font-medium uppercase "
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
                                class="w-24 px-2 py-2 cursor-pointer text-left text-xs font-medium uppercase ">
                                Active
                            </th>
                            <th scope="col"
                                class="w-24 px-2 py-2 cursor-pointer text-left text-xs font-medium uppercase "
                                wire:click="">
                                used
                            </th>
                            <th scope="col"
                                class="w-24 px-2 py-2 cursor-pointer text-left text-xs font-medium uppercase "
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
                                class="w-24 px-2 py-2 cursor-pointer text-left text-xs font-medium uppercase "
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
                                class="w-24 px-2 py-2 cursor-pointer text-left text-xs font-medium uppercase "
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
                                class="w-24 px-2 py-2 cursor-pointer text-left text-xs font-medium uppercase "
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
                                class="w-24 px-2 py-2 cursor-pointer text-left text-xs font-medium uppercase "
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
                    <tbody class="bg-white divide-y divide-gray-200">
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
                                        @livewire('edit-coupon', ['coupon' => $coupon], key($coupon->id))
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

        </x-wraper>
    </div>

</div>
