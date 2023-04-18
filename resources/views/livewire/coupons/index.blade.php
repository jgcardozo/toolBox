{{-- @extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @livewire('coupons')
        </div>     
    </div>   
</div>
@endsection --}}


@extends('adminlte::page')

@section('title', 'Coupons')

@section('content_header')
    <div class="container-fluid">
        <h2>Listing Coupons</h2>
    </div>
@stop

@section('content')
    @livewire('coupons')
@stop
