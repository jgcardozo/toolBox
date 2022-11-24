@section('title', __('Clients'))


<div class="card">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div class="float-left">
                <h4>Client Listing </h4>
            </div>
            @if (session()->has('message'))
                <div wire:poll.10s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;">
                    {{ session('message') }} </div>
            @endif
            <div>
                <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                    placeholder="Search Clients">
            </div>
            <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
                <i class="fa fa-plus mr-1"></i> Add Clients
            </div>
        </div>
    </div>

    <div class="card-body">
        @include('livewire.clients.create')
        @include('livewire.clients.update')
        @if (count($clients) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead bg-dark">
                        <tr>
                            <th class="cursor-pointer px-6 py-3 text-left" wire:click="order('id_nro')"># Id
                                @if ($sort == 'id_nro')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="px-6 py-3 text-left">Tipo</th>
                            <th class="cursor-pointer px-6 py-3 text-left" wire:click="order('name')">Name
                                @if ($sort == 'name')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th class="cursor-pointer px-6 py-3 text-left" wire:click="order('email')">Email
                                @if ($sort == 'email')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            <th>Estado</th>
                            <th>{{__('actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $row)
                            <tr>
                                <td>{{ $row->id_nro }}</td>
                                <td>{{ $row->client_type }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>por validar</td>
                                <td width="90">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                wire:click="edit({{ $row->id }})"><i
                                                    class="fa fa-file-pdf mr-1"></i>
                                                Quote
                                            </a>
                                            <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                wire:click="edit({{ $row->id }})"><i class="fa fa-file mr-1"></i>
                                                Report
                                            </a>
                                            <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                wire:click="edit({{ $row->id }})"><i class="fa fa-pen mr-1"></i>
                                                Edit
                                            </a>
                                            <a class="dropdown-item"
                                                onclick="confirm('Confirm Delete Client id {{ $row->id }}? \nDeleted Clients cannot be recovered!')||event.stopImmediatePropagation()"
                                                wire:click="destroy({{ $row->id }})"><i
                                                    class="fa fa-trash mr-1"></i>
                                                Delete </a>
                                        </div>
                                    </div>
                                </td>
                        @endforeach
                    </tbody>
                </table>
                {{ $clients->links() }}
            </div>
        @else
            <div class="text-center">{{__('not_maching_data')}}</div>
        @endif
    </div>
</div>
