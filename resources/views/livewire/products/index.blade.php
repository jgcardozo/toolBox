@extends('adminlte::page')

@section('title', 'products_title')

@section('content_header')
    <div class="container-fluid">
        <button class="btn btn-dark"><i class="fas fa-file-excel mr-2"></i>{{ __('export_excel') }}</button>
        <button class="btn btn-dark"><i class="fas fa-file-pdf mr-2"></i>{{ __('export_pdf') }}</button>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        @livewire('products')
    </div>
@stop

