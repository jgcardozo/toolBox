@extends('adminlte::page')

@section('title', __('roles_title_create'))

@section('content_header')
    <h2>{{__('roles_header_create')}}</h2>
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
