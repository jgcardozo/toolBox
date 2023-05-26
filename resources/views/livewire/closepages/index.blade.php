@extends('adminlte::page')

@section('title', 'ClosePages')

@section('content_header')
    <div class="container-fluid">
        <h2>Pages To Close</h2>
    </div>
@stop

@section('content')
    @livewire('close-pages')
@stop
