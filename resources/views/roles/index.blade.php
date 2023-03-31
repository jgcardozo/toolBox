@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="container-fluid">
        @can('roles.create')
            <a href="{{ route('roles.create') }}" class="btn btn-info float-right">
                <i class="fas fa-user-shield mr-2"></i>{{ __('roles_new') }}
            </a>
        @endcan
        <h2>{{ __('roles_header') }}</h2>
    </div>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-info">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Role {{ __('name') }}</th>
                            <th>Role {{ __('description') }}</th>
                            <th colspan="2">{{ __('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    @can('roles.edit')
                                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-pen mr-2"></i>{{ __('edit') }}
                                        </a>
                                    @endcan
                                </td>
                                <td>
                                    {{--    --}}
                                    @can('roles.destroy')
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['roles.destroy', $role],
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
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@stop
