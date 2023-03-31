@extends('adminlte::page')

@section('title', 'Permission:create')

@section('content_header')
    <h2></h2>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Permission Create</h2>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('permissions.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="i.e: domains.create"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" placeholder="ie: permission to create domains" value="{{ old('slug') }}">
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <hr>
                            <a class="btn btn-dark" href="{{ route('permissions.index') }}" role="button"><i
                                    class="fas fa-chevron-circle-left mr-2"></i>Back</a>
                            {{-- <button type="reset" class="btn btn-primary"><i class="fas fa-broom mr-2"></i>Limpiar</button> --}}
                            <button type="submit" class="btn btn-info"><i
                                    class="fas fa-plus-circle mr-2"></i>Save</button>

                        </form>



                    </div><!-- card-body -->

                </div>
            </div>
        </div>
    </div>
@stop
