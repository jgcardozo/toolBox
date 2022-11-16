@extends('adminlte::page')

@section('title', 'Usuarios:edit')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="mb-2">
                            <label>Nombre:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label>Email:</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="name"
                                value="{{ $user->email }}" readonly>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <label>Roles:</label>
                        {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put']) !!}
                        @foreach ($roles as $role)
                            <div>
                                <label>
                                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                                    {{ $role->name }} <em class="ml-1">({{ $role->description }})</em>
                                </label>
                            </div>
                        @endforeach
                        {!! Form::submit('Guardar', ['class' => 'btn btn-info mt-2']) !!}
                        {!! Form::close() !!}
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop
