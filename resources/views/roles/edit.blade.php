@extends('adminlte::page')

@section('title', __('roles_title_edit'))

@section('content_header')
    <h2>{{__('roles_header_edit')}}</h2>
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
