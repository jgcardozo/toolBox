@extends('adminlte::page')

@section('title', 'Domain:Edit')

@section('content_header')
    <div class="container-fluid">
        <h2>Edit Domain</h2>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
        

                <form action="{{ route('domains.update' , $domain->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Ftp Name</label>
                        <input type="text" placeholder="test.askmethod.com" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{$domain->name}}" />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Ftp Url</label>
                        <input type="text" placeholder="Ftp Url" name="ftp_url"
                            class="form-control @error('ftp_url') is-invalid @enderror" value="{{$domain->ftp_url}}" />
                        @error('ftp_url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Ftp User</label>
                        <input type="text" placeholder="Ftp User" name="ftp_user"
                            class="form-control @error('ftp_user') is-invalid @enderror" value="{{$domain->ftp_user}}" />
                        @error('ftp_user')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Ftp Password</label>
                        <input type="text" placeholder="Ftp Password" name="ftp_password"
                            class="form-control @error('ftp_password') is-invalid @enderror"
                            value="{{$domain->ftp_password}}" />
                        @error('ftp_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>Server Type</label>
                        <select name="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="0">Choose...</option>
                            <option value="Apache"  @if ($domain->type == "Apache") {{'selected'}} @endif>Apache (it will use .htaccess File)</option>
                            <option value="Nginx"   @if ($domain->type == "Nginx") {{'selected'}} @endif>Nginx (it will create folder)</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button class="btn btn-info" type="submit">Create Domain</button>

                </form>
            </div>

        </div>
    </div>
@stop
