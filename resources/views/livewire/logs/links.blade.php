{{-- dataTables
https://www.youtube.com/watch?v=qgG8fUDO9Kc
https://www.youtube.com/watch?v=X-QC6uZXuk0 
--}}

{{-- quitar cache del navegador
https://decodecms.com/refrescar-los-estilos-css-almacenados-en-el-navegador-de-un-usuario/ 
--}}
<div>
 <div class="table-reponsive mb-3">

    <table class="table table-striped" id="tb_logs">
        <thead class="bg-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Action</th>
                <th scope="col">Alias</th>
                <th scope="col">User</th>
                <th scope="col">Previous</th>
                <th scope="col">Current</th>
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
                    <td>{{ $item->json_old }}</td>
                    <td>{{ $item->json_new }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>
</div>
<!--wrap-->


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
