@extends('adminlte::page')

@section('title', 'Links')

@section('content_header')
    <div class="container-fluid">
        @can('links.create')
            <a href="{{ route('links.create') }}" class="btn btn-info float-right">
                <i class="fas fa-plus-circle mr-2"></i>New Link
            </a>
        @endcan
        <h2>Listing Links</h2>
    </div>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-info">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    @livewire('links')

@stop
