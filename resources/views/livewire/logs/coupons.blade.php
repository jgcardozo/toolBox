{{-- dataTables
https://www.youtube.com/watch?v=qgG8fUDO9Kc
https://www.youtube.com/watch?v=X-QC6uZXuk0 
--}}

{{-- quitar cache del navegador
https://decodecms.com/refrescar-los-estilos-css-almacenados-en-el-navegador-de-un-usuario/ 
--}}
@extends('adminlte::page')

@section('title',  $logTitle  )

@section('content_header')
    <div class="container-fluid">
        <h2>{{ $logTitle }}</h2>
    </div>
@stop

@section('content')
    <div class="table-responsive my-3" style="width: 100%;">

        <table class="table table-striped " id="tb_logs">
            <thead class="bg-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Action</th>
                    <th scope="col">Coupon-Name</th>
                    <th scope="col">User</th>
                    <th scope="col">Info-Prev</th>
                    <th scope="col">Info-Now</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($item->action) }}</td>
                        <td>{{ $item->keyword }}</td>
                        <td>{{ $item->user_name }}</td>
                        <td>{!! nl2br($item->json_old) !!}</td>
                        <td>{!! nl2br($item->json_new) !!}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>

@stop



@section('plugins.Datatables', true)

{{-- https://www.youtube.com/watch?v=X-ul2doEgBo --}}
@push('js')
    <script>
        $(document).ready(function() {
            $('#tb_logs').DataTable({
                //"paging": false,
                //"lengthChage": false,
                //"searching": false,
                //"ordering": false
                //"info":true,
                //"autoWidth": false,
                "responsive": true,
                "buttons": ["excel"]
            });
        });
    </script>
@endpush
