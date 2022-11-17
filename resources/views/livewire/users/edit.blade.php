@extends('adminlte::page')

@section('title', 'Usuarios:edit')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">              
                {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT']) !!}

                @include('livewire.users.form')

                {!! Form::close() !!}
            </div> <!--card-body-->
        </div>
    </div>
@stop
