@extends('adminlte::page')

@section('title', __('users_title_edit'))

@section('content_header')
    <h2>{{__('users_header_edit')}}</h2>
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
