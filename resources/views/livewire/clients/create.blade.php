<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="id_nro">Id Nro</label>
                            <input wire:model="id_nro" type="text" class="form-control" id="id_nro"
                                placeholder="Digite nro de identidad">
                            @error('id_nro')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="id_type">{{ __('id_types') }}</label>
                            <select class="form-control" wire:model="id_type" id="id_type">
                                <option value="null">- Select one</option>
                                @foreach ($itypes as $idtype)
                                    <option value="{{ $idtype->id }}">{{ $idtype->description }}</option>
                                @endforeach
                            </select>
                            @error('id_type')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <label for="empresa">Empresa/Fondo donde Labora</label>
                            <input     type="text" class="form-control" id="empresa"
                                placeholder="aun no implemantado">
                            @error('empresa')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="name">{{ __('name') }}</label>
                            <input wire:model="name" type="text" class="form-control" id="name"
                                placeholder="Digite nombres y apellidos">
                            @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email">{{ __('email') }}</label>
                            <input wire:model="email" type="text" class="form-control" id="email"
                                placeholder="Digite {{ __('email') }}">
                            @error('email')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="phone">{{ __('phone') }}</label>
                            <input wire:model="phone" type="text" class="form-control" id="phone"
                                placeholder="Phone">
                            @error('phone')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="cities">{{ __('cities') }}</label>
                            <select class="form-control" wire:model="city_id" id="city_id">
                                <option value="null">- Select one</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->description }}</option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <label for="address">{{ __('address') }}</label>
                            <input wire:model="address" type="text" class="form-control" id="address"
                                placeholder="Address">
                            @error('address')
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
                <button type="button" wire:click.prevent="store()" class="btn btn-info close-modal">
                    <i class="fa fa-sd-card mr-2"></i>{{ __('save') }}
                </button>
            </div>
        </div>
    </div>
</div>
