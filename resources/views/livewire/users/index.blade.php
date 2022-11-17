@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    @can('users.create')
        <a href="{{ route('users.create') }}" class="btn btn-info float-right">
            <i class="fas fa-user-plus mr-2"></i>Agregar Usuario
        </a>
    @endcan
    <h2>Lista de Usuarios</h2>
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
