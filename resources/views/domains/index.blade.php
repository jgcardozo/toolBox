@extends('adminlte::page')

@section('title', 'Domains')

@section('content_header')
    <div class="container-fluid">
        @can('domains.create')
            <a href="{{ route('domains.create') }}" class="btn btn-info float-right">
                <i class="fas fa-plus-circle mr-2"></i>New Domain
            </a>
        @endcan
        <h2>Domains Listing</h2>
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
                            <th>#</th>
                            <th>Domain</th>
                            <th># Links</th>
                            <th>Type</th>
                            <th>ID</th>
                            <th colspan="2">{{ __('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                        @forelse ($domains as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->cant }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @can('domains.edit')
                                        <a href="{{ route('domains.edit', $item) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-pen mr-2"></i>{{ __('edit') }}
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    @can('domains.destroy')
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['domains.destroy', $item],
                                            'onsubmit' => 'return confirm("Are you sure ?")',
                                            //'onsubmit' => 'return confirm(__("Are you sure you want to run this action?"))',
                                        ]) !!}
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash mr-2"></i>{{ __('delete') }}
                                        </button>
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-light" role="alert" style="background-color: #fff;">
                                There's any Domain so far !
                            </div>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@stop
