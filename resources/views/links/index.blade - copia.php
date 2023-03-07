@extends('adminlte::page')

@section('title', 'Links')

@section('content_header')
    <div class="container-fluid">
        @can('links.create')
        <a href="{{ route('links.create') }}" class="btn btn-info float-right">
            <i class="fas fa-plus mr-2"></i>New Link
        </a>
        @endcan
        <h2>Create Link</h2>
    </div>
@stop

@section('content')
    <div class="container-fluid">

        @if (session('info'))
            <div class="alert alert-info">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="">
                        <tr>
                            <th>Short Url</th>
                            <th>Long Url</th>
                            <th>Last Updated</th>
                            <th>User</th>
                            <th colspan="2">{{ __('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($links as $item)
                            <tr>     
                                <td><a href="{{ $item->short_url }}" target="_blank">{{ $item->short_url }}</a></td>
                                <td><a href="{{ $item->long_url }}" target="_blank">{{ $item->long_url }}</a></td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{{ $item->user_name }}</td>
                                
                                <td>
                                    @can('links.edit')
                                        <a href="{{ route('links.edit', $item) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('domains.destroy')
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['links.destroy', $item],
                                            'onsubmit' => 'return confirm("Are you sure ?")',
                                            //'onsubmit' => 'return confirm(__("Are you sure you want to run this action?"))',
                                        ]) !!}
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@stop
