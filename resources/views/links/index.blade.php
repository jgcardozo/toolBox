@extends('adminlte::page')

@section('title', 'Links')

@section('content_header')
    <div class="container-fluid">
        @can('links.create')
            <a href="{{ route('links.create') }}" class="btn btn-info float-right">
                <i class="fas fa-plus mr-2"></i>New Link
            </a>
        @endcan
        <h2>Listing Links</h2>
    </div>
@stop

@section('content')
    <div class="container-fluid">

        @if (session('info'))
            <div class="alert alert-info">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif


        @forelse ($links as $item)
            <div class="card border- primary mb-3">
                <div class="row no-gutters">
                    <div class="col-md-11">
                        <div class="card-body " style="color:blueviolet;">

                            <p class="card-text">
                            <div class="float-left">
                                <i class="fas fa-fw fa-link mr-2"></i>
                                <a href="{{ $item->short_url }}" target="_blank">{{ $item->short_url }}</a>
                            </div>
                            <div class="float-right">
                                <i class="fas fa-fw fa-user mr-2"></i>{{ $item->user_name }}
                            </div>
                            </p>


                            <p class="card-text">
                                <i class="fas fa-fw fa-globe mr-2"></i>
                                <a href="{{ $item->long_url }}" target="_blank">{{ $item->long_url }}</a>
                            </p>
                            <p class="card-text"><small style="color:blueviolet;">Last updated:
                                    {{ $item->updated_at }}</small></p>
                        </div>
                    </div>
                    <div class="col-sm-1 my-auto text-center">
                        <div class="row ">
                            <div class="col-lg-12">

                                @can('links.edit')
                                    <a href="{{ route('links.edit', $item) }}" class="btn btn-sm btn-info my-1">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                @endcan
                            </div>
                            <div class="col-lg-12">

                                @can('domains.destroy')
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['links.destroy', $item],
                                        'onsubmit' => 'return confirm("Are you sure ?")',
                                        //'onsubmit' => 'return confirm(__("Are you sure you want to run this action?"))',
                                    ]) !!}
                                    <button type="submit" class="btn btn-sm btn-danger my-1">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @endcan
                            </div>


                        </div>

                    </div>
                </div>
            </div>

        @empty
            <div class="alert alert-info" role="alert">
                There's any link so far !
            </div>
        @endforelse

    </div>
@stop
