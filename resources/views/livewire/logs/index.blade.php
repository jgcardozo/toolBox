@extends('adminlte::page')

@section('title', 'Logs:Links')

@section('content_header')
    <div class="container-fluid">
        <h2>Log Links</h2>
    </div>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-info">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    @livewire('logs')

@stop
