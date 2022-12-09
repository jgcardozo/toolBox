@section('title', __('products'))


<div class="card">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div class="float-left">
                <h4>Product Listing </h4>
            </div>
            @if (session()->has('message'))
                <div wire:poll.10s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                    {{ session('message') }} </div>
            @endif
            <div>
                <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                    placeholder="Buscar Productos">
            </div>
            <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
                <i class="fa fa-plus mr-1"></i> Add Products
            </div>

            {{--  <a href="{{ route('productos.create') }}" class="btn btn-sm btn-info">
                <i class="fas fa-plus mr-2"></i>{{ __('products_new') }}
            </a> --}}
        </div>
    </div>

    <div class="card-body">
        @include('livewire.products.create')
        @include('livewire.products.update')
        @if (count($products) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead bg-dark">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="cursor-pointer px-6 py-3 text-left" wire:click="order('description')">
                                Descripción
                                @if ($sort == 'description')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-6 py-3 text-left" wire:click="order('price')">
                                Precio
                                @if ($sort == 'price')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-6 py-3 text-left" wire:click="order('producttype_id')">Tipo
                                Producto
                                @if ($sort == 'producttype_id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="px-6 py-3 text-left">Fotos</th>
                            <th class="px-6 py-3 text-left">{{ __('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $row->description }}</td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->producttype_name }}</td>
                                <td>por validar</td>
                                <td width="90">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if (count($row->images) > 0)
                                                <a class="dropdown-item" href="{{ route('products.show', $row) }}"><i
                                                        class="fa fa-eye mr-1"></i>
                                                    Info Producto
                                                </a>
                                            @else
                                                <a class="dropdown-item"
                                                    href="{{ route('products.formImage', $row) }}"><i
                                                        class="fa fa-image mr-1"></i>
                                                    Subir Imagenes
                                                </a>
                                            @endif
                                            <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                wire:click="edit({{ $row->id }})"><i class="fa fa-pen mr-1"></i>
                                                Edit
                                            </a>
                                            <a class="dropdown-item"
                                                onclick="confirm('Confirm Delete Client id {{ $row->id }}? \nDeleted Clients cannot be recovered!')||event.stopImmediatePropagation()"
                                                wire:click="destroy({{ $row->id }})"><i
                                                    class="fa fa-trash mr-1"></i>
                                                Delete </a>
                                            <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                wire:click="edit({{ $row->id }})"><i
                                                    class="fa fa-file-word mr-1"></i>
                                                Planes de Pago
                                            </a>
                                        </div>
                                    </div>
                                </td>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center">{{ __('not_maching_data') }}</div>
        @endif
    </div>
</div>
