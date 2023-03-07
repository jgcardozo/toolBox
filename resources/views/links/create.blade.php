@extends('adminlte::page')

@section('title', 'Links:Create')

@section('content_header')
    <div class="container-fluid">
        <h2>New Short Link</h2>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('links.store') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text"><i class="fas fa-fw fa-cloud mr-2"></i>Long Url</label>
                        </div>
                        <input type="text" name="long_url" class="form-control @error('long_url') is-invalid @enderror"
                            placeholder="Type or paste Url" value="{{ old('long_url') }}">
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
                            <select class="custom-select @error('domain_id') is-invalid @enderror" name="domain_id">
                                <option value="0" selected>Choose...</option>
                                @foreach ($domains as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('domain_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('domain_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3 col-sm-4">
                            <div class="input-group-prepend">
                                <label class="input-group-text"><i class="fas fa-fw fa-link mr-2"></i>Alias</label>
                            </div>
                            <input type="text" name="alias" class="form-control @error('alias') is-invalid @enderror"
                                placeholder="quizmas" value="{{ old('alias') }}">
                            @error('alias')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-info" type="submit">Create ShortLink</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@stop
