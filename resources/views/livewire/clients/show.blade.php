@extends('adminlte::page')

@section('title', 'Cliente:Imagenes')

@section('content_header')
    <div class="container-fluid">
        <h2 class="mt-3">Cliente visualizar Imagenes</h2>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="id_nro">Id Nro</label>
                        <input name="id_nro" type="text" class="form-control" value="{{ $client->id_nro }}" readonly>
                        @error('id_nro')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="id_type">{{ __('id_types') }}</label>
                        <select class="form-control" name="id_type" disabled>
                            <option value="0">- Select one</option>
                            @foreach ($ptypes as $type)
                                <option value="{{ $type->id }}"
                                    @if ($client->id_type == $type->id) {{ 'selected' }} @endif>
                                    {{ $type->description }} </option>
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
                        <input type="text" class="form-control" name="empresa" placeholder="aun no implemantado">
                        @error('empresa')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">{{ __('name') }}</label>
                        <input name="name" type="text" class="form-control" value="{{ $client->name }}" readonly>
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email">{{ __('email') }}</label>
                        <input name="email" type="text" class="form-control" value="{{ $client->email }}" readonly>
                        @error('email')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="phone">{{ __('phone') }}</label>
                        <input name="phone" type="text" class="form-control" value="{{ $client->phone }}" readonly>
                        @error('phone')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="cities">{{ __('cities') }}</label>
                        <select class="form-control" name="city_id" disabled>
                            <option value="0">- Select one</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    @if ($client->city_id == $city->id) {{ 'selected' }} @endif>
                                    {{ $city->description }} </option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="address">{{ __('address') }}</label>
                        <input wire:model="address" type="text" class="form-control" value="{{ $client->address }}"
                            readonly placeholder="Address">
                        @error('address')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="d-flex justify-content-around">

                    <div style="width:70%; background-color:#e7e7e7; border-radius:8px; padding-top:10px; padding-bottom:10px;"
                        class="d-flex justify-content-around row">
                        @forelse ($client->images as $img)                          
                            <img width="150px" src="{{ asset($img->url) }}" class="img-rounded my-2">
                        @empty
                            <div class="alert alert-info">Clientes no tiene imagenes asignadas</div>
                        @endforelse
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-backward mr-2"></i>{{ __('cancel') }}
                    </button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-info" data-dismiss="modal">
                        <i class="fa fa-sd-card mr-2"></i>{{ __('save') }}
                    </button>
                </div>

            </div> {{-- card-body --}}
        </div>




    </div>

@stop
