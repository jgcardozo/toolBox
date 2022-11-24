<div class="row">
    <div class="form-group col-sm-6">
        <div class="mb-2">
            {!! Form::label('name', __('name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @error('name')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
        <div class="mb-2">
            {!! Form::label('email', __('email')) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            @error('email')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>
   {{--      
    campo password
    <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" name="status" id="status" @if ($user->active)
                checked
            @endif>
          
            <label class="custom-control-label" for="status" checked>Acceso Activado ?</label> 
        </div> --}}

    </div>


    <div class="col-sm-6">
        <label>Role(s):</label>
        @foreach ($roles as $role)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                    {{ $role->name }} <em class="ml-1">({{ $role->description }})</em>
                </label>
            </div>
        @endforeach
    </div>

</div>

<div class="row">
    <div class="col-sm-12 text-center">
        <a href="{{ route('users.index') }}" class="btn btn-secondary"><i
                class="fa fa-backward mr-2"></i>{{ __('cancel') }}</a>

        <button type="submit" class="btn btn-info">
            <i class="fa fa-sd-card mr-2"></i>{{ __('save') }}
        </button>
    </div>
</div>
