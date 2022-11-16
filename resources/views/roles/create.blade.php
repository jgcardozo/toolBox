@extends('adminlte::page')

@section('title', 'Role:create')

@section('content_header')
    <h2>Crear Role</h2>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'roles.store']) !!}

                @include('roles.form')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
