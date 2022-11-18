@extends('adminlte::page')

@section('title', __('users_title_create'))

@section('content_header')
    <h2>{{__('users_header_create')}}</h2>
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