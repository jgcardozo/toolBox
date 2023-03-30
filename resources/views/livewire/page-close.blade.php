@extends('adminlte::page')

@section('title', 'Pages to Close')

@section('content_header')

        <a href="{{ route('users.create') }}" class="btn btn-info float-right">
            <i class="fas fa-user-plus mr-2"></i>Schedule a close
        </a>
   
    <h2>header</h2>
@stop

@section('content')
    <div class="container-fluid">
        @if (session('info'))
            <div class="alert alert-info">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif
        
    </div>
@stop
