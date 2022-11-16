<div class="row">
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @error('name')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('description', 'Descripción') !!}
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
        <h2>Lista de Permisos</h2>
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
        <a href="{{route('roles.index')}}" class="btn btn-secondary">Cancelar</a>
        {!! Form::submit('Guardar', ['class' => 'btn btn-info']) !!}
    </div>
</div>
