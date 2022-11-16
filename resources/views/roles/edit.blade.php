@extends('adminlte::page')

@section('title', 'Role:edit')

@section('content_header')
    <h2>Edit Role</h2>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                {!! Form::model($role, ['route' => ['roles.update', $role], 'method' => 'PUT']) !!}

                @include('roles.form')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
