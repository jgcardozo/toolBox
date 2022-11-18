@extends('adminlte::page')

@section('title', __('dashboard_header'))

@section('content_header')
    <h1>{{__('dashboard_title')}}</h1>
@stop

@section('content')
    <p>Welcome to this beautiful CRM. Developed by juanguillermopc@gmail.com</p>
@stop

@section('css')
   {{--  <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop