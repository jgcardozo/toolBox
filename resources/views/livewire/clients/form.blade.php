@extends('adminlte::page')

@section('title', 'Cliente:Imagenes')

@section('content_header')
    <div class="container-fluid">
        <h2>Cliente cargar Imagenes</h2>
    </div>
@stop

@section('content')
    <div class="container-fluid">

        <div class="alert alert-info" id="alert" style="display: none;">message here</div>

        <div class="card">
            <div class="card-body">
                <form id="upload-form" class="dropzone">
                    <input type="hidden" name="clientId" value="{{ $client->id }}" />
                    <div class="row">
                        <div class="previews"></div>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    <a type="button" class="btn btn-secondary" href="{{ route('clients') }}">
                        <i class="fa fa-backward mr-2"></i>{{ __('cancel') }}
                    </a>
                    <button type="button" class="btn btn-info" id="btn-dropzone">
                        <i class="fa fa-image mr-2"></i>{{ __('save') }}
                    </button>
                </div>
            </div> <!-- "card-body -->
        </div>

    </div>
@stop




@section('js')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script type="text/javascript">
        console.log('Hi clients show!');
        Dropzone.options.uploadForm = {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            autoProcessQueue: false,
            url: "storeImage",
            uploadMultiple: true,
            parallelUploads: 4,
            maxFiles: 4,
            maxFilesSize: 2,
            acceptedFiles: ".jpg,jpeg,.png",
            dictDefaultMessage: 'Arrasta y suelta acá las imagenes',
            addRemoveLinks: true,
            init: function() {
                var submitButton = document.querySelector("#btn-dropzone")
                myDropzone = this;
                submitButton.addEventListener("click", function() {
                    myDropzone.processQueue();
                });
                this.on("successmultiple", function(files, response) {
                    var myAlert = document.getElementById("alert");
                    myAlert.innerHTML = response.message;
                    myAlert.style.display = 'block';
                    setInterval(function() {
                        window.location = "{{route('clients')}}";
                    }, 3000);
                   
                });

            } //init
        }
    </script>
@stop
