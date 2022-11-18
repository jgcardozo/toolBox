@extends('adminlte::page')

@section('title', __('users_title'))

@section('content_header')
    @can('users.create')
        <a href="{{ route('users.create') }}" class="btn btn-info float-right">
            <i class="fas fa-user-plus mr-2"></i>{{__('users_new')}}
        </a>
    @endcan
    <h2>{{__('users_header')}}</h2>
@stop

@section('content')
    <div class="container-fluid">
        @if (session('info'))
            <div class="alert alert-info">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif
        @livewire('users')
    </div>
@stop
