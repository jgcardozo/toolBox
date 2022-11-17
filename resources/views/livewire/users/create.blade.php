@extends('adminlte::page')

@section('title', 'User:create')

@section('content_header')
    <h2>Crear Usuario</h2>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'users.store']) !!}

                @include('livewire.users.form')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop