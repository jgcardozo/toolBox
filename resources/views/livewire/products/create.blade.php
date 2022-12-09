<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="producttype_id">Tipo Producto</label>
                            <select class="form-control" wire:model="producttype_id" id="producttype_id">
                                <option value="null">- Select one</option>
                                @foreach ($ptypes as $idtype)
                                    <option value="{{ $idtype->id }}">{{ $idtype->description }}</option>
                                @endforeach
                            </select>
                            @error('producttype_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="brand_id">Marca</label>
                            <select class="form-control" wire:model="brand_id" id="brand_id">
                                <option value="null">- Select one</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->description }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

            
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="description">{{ __('description') }}</label>
                            <input wire:model="description" type="text" class="form-control" id="description">
                            @error('description')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="price">Precio</label>
                            <input wire:model="price" type="text" class="form-control" id="price">
                            @error('price')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="name">Referencia</label>
                            <input wire:model="reference" type="text" class="form-control" id="reference"
                                placeholder="Codigo personalizado">
                            @error('reference')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email">Referencia Alt</label>
                            <input wire:model="reference2" type="text" class="form-control" id="reference2"
                                placeholder="Codigo personalizado 2">
                            @error('reference2')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </form>
            </div><!-- modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">
                    <i class="fa fa-backward mr-2"></i>{{ __('cancel') }}
                </button>
                <button type="submit" wire:click.prevent="store()" class="btn btn-info close-modal">
                    <i class="fa fa-sd-card mr-2"></i>{{ __('save') }}
                </button>
            </div>
        </div>
    </div>
</div>
