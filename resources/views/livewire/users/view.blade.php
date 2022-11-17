<div>
    <div class="card mt-3">
        <div class="card-header">
            <input type="text" wire:model="search" class="form-control" placeholder="Digite nombre o email">
        </div>
        @if ($users->count())
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Role(s)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (count($user->roles))
                                            @foreach ($user->roles as $role)
                                                {{ '* ' . $role->name }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @can('users.edit')
                                            <a class="btn btn-sm btn-info" href="{{ route('users.edit', $user) }}">
                                                <i class="fa fa-pen mr-2"></i>Editar</a>
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('users.destroy')
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['users.destroy', $user],
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
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body text-center">
                <strong>No hay registros</strong>
            </div>
        @endif
    </div>
</div>
