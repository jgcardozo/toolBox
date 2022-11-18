<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('name', __('name')) !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @error('name')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('description', __('description')) !!}
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
        @error('description')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <h2>{{__('permissions_header')}}</h2>
        @foreach ($permissions as $perm)
            <div>
                <label>
                    {!! Form::checkbox('permissions[]', $perm->id, null, ['class' => 'mr-1']) !!}
                    {{ $perm->description }}<em class="ml-2">({{ $perm->name }})</em>
                </label>
            </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-sm-12 text-center">
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
            <i class="fa fa-backward mr-2"></i>{{__('cancel')}}
        </a>

        <button type="submit" class="btn btn-info">
            <i class="fa fa-sd-card mr-2"></i>{{__('save')}}
        </button>
    </div>
</div>
