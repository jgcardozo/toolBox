@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
    <div class="container-fluid">
        @can('permissions.create')
            <a href="{{ route('permissions.create') }}" class="btn btn-info float-right">
                <i class="fas fa-plus-circle mr-2"></i>New Permission
            </a>
        @endcan
        <h2>Permissions Listing</h2>
    </div>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-info">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif


            <div class="table-responsive" style="background-color: #fff;">
                <table class="table table-striped">
                    <thead class="bg-dark">
                        <tr>
                            <th>ID</th>
                            <th>Role {{ __('name') }}</th>
                            <th>Role {{ __('description') }}</th>
                            <th colspan="2">{{ __('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $perm)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $perm->name }}</td>
                                <td>{{ $perm->description }}</td>
                                <td width="5px">
                                    @can('permissions.edit')
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                    @endcan
                                </td>
                                <td width="5px">
                                    <form action="{{ route('permissions.destroy', $perm) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure You want to delete this permission ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
   


    <div class="row">
        <div class="mx-auto">
            {{ $permissions->links() }}
        </div>
    </div>
@stop
