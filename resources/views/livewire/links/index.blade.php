@extends('adminlte::page')

@section('title', 'Links')

@section('content_header')
    <div class="container-fluid">
        @can('links.create')
            <a href="{{ route('links.create') }}" class="btn btn-sm btn-info float-right">
                <i class="fas fa-plus-circle mr-2"></i>New Link
            </a>
        @endcan

        @if (count($logs) > 0)
            <a href="{{ route('log.type', 'link') }}" class="btn btn-sm btn-dark float-right mx-1" target="_blank">
                <i class="fas fa-file mr-2"></i>Log Links
            </a>
        @endif
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
