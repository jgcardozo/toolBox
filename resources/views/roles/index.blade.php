@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    @can('roles.create')
        <a href="{{ route('roles.create') }}" class="btn btn-info float-right">
            <i class="fas fa-user-shield mr-2"></i>Agregar Role
        </a>
    @endcan
    <h2>Lista de Roles</h2>
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
                            <th>ID</th>
                            <th>Role Name</th>
                            <th>Role Description</th>
                            <th colspan="2">Actions</th>
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
                                            <i class="fa fa-pen mr-2"></i>Editar</a>
                                    @endcan
                                </td>
                                <td>
                                    @can('roles.destroy')
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['roles.destroy', $role],
                                            'onsubmit' => 'return confirm("Are you sure ?")',
                                        ]) !!}
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash mr-2"></i>Elminar
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
