@extends('adminlte::page')

@section('title', 'Link:Edit')

@section('content_header')
    <div class="container-fluid">
        <h2>Edit Link</h2>
    </div>
@stop

@section('content')

<div class="container-fluid">
        <div class="card">
            <div class="card-body">

               <form action="{{ route('links.update' , $link->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text"><i class="fas fa-fw fa-cloud mr-2"></i>Long Url</label>
                        </div>
                        <input type="text" name="long_url" class="form-control @error('long_url') is-invalid @enderror"
                            placeholder="Type or paste Url" value="{{ $link->long_url }}">
                        @error('long_url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="input-group mb-3 col-sm-8">
                            <div class="input-group-prepend">
                                <label class="input-group-text"><i class="fas fa-fw fa-globe mr-2"></i>Domain</label>
                            </div>
                            <input type="text" name="domain_name" class="form-control @error('long_url') is-invalid @enderror"
                             value="{{ $link->domain_name }}" readonly>
                        </div>

                        <div class="input-group mb-3 col-sm-4">
                            <div class="input-group-prepend">
                                <label class="input-group-text"><i class="fas fa-fw fa-link mr-2"></i>Alias</label>
                            </div>
                            <input type="text" name="alias" class="form-control @error('alias') is-invalid @enderror"
                                placeholder="quizmas" value="{{ $link->alias }}" readonly>
                            @error('alias')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <a class="btn btn-dark mx-1" href="{{ route('links.index') }}"><i class="fas fa-solid fa-backward mr-2"></i>Back</a>
                        <button class="btn btn-info" type="submit">Edit<i class="fas fa-pen ml-2"></i></button>
                    </div>

                </form>
            </div>

        </div>
    </div>

@stop
