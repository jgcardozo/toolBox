@extends('adminlte::page')

@section('title', 'Coupons')

@section('content_header')
    <div class="container-fluid row">
        <h2 class="col-md-10">Listing Coupons</h2>
        <a href="{{ route('log.type', 'Coupon') }}" class="btn btn-sm btn-dark col-md-2" target="_blank"
            style="height: fit-content;">
            <i class="fas fa-file mr-2"></i>Log Coupons
        </a>
    </div>
@stop

@section('content')
    @livewire('coupons')
@stop
