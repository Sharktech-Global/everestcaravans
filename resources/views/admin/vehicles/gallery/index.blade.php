@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Vehicle Gallery</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
            <a class="breadcrumb-item" href="#"
                target="_blank">{{ $vehicle->name }}</a>
            <span class="breadcrumb-item active">Gallery</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Images</h3>
            </div>
            <div class="block-content">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                @endif
                @if ($errors->any())
                    <div id="error-box">
                        <!-- Display errors here -->
                    </div>
                @endif
                <div class="alert alert-success alert-dismissable d-none" id='successm' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p class="mb-0" id='st_message'></p>
                </div>

                <div class="container">
                    <div class="form-group row">
                        <div class="col-md-12 @error('name') is-invalid @enderror">
                            <form method="post" action="{{ route('admin.vehicles.gallery.store', $vehicle->id) }}"
                                enctype="multipart/form-data" class="dropzone" id="dropzone">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">View Images</h3>

            </div>
            <div class="block-content">
                <div class="alert alert-success alert-dismissable d-none" id='successme' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p class="mb-0" id='st_messagem'></p>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter" id='myTable'>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($images->sortByDesc('updated_at') as $data)
                                <tr>
                                    <td width='250px'><input type="text" class="form-control"
                                            id='text-{{ $data->id }}' data-id='{{ $data->id }}'
                                            value="{{ $data->title }}"></td>
                                    <td><img src="{{ asset('upload/vehicle/gallery/' . $data->image) }}" width="150px">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        title="Delete"
                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete this image?')){ document.getElementById('delete-data-{{ $data->id }}').submit();}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="delete-data-{{ $data->id }}"
                                        action="{{ route('admin.vehicles.gallery.destroy',[$vehicle->id,$data->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_after')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function throttle(f, delay) {
            var timer = null;
            return function() {
                var context = this,
                    args = arguments;
                clearTimeout(timer);
                timer = window.setTimeout(function() {
                        f.apply(context, args);
                    },
                    delay || 500);
            };
        }
        $('input').keyup(throttle(function() {
            var data = $(this).val();
            if (data) {
                $(this).css('border-color', '#d4dae3');
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.vehicles.gallery.imagename', $vehicle->id) }}",
                    data: {
                        data: data,
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status == '1') {
                            $('#successme').removeClass('d-none');
                            $("#st_messagem").html("<p> " + data.message + "</p>");
                            window.setTimeout(function() {
                                $('#successme').addClass('d-none');
                            }, 1000)
                        }
                    }
                });
            }else{
                $(this).css('border-color', 'red');
            }

        }));

        Dropzone.options.dropzone = {
            maxFilesize: 10,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.svg",
            addRemoveLinks: true,
            timeout: 60000,
            success: function(file, response) {
                $('#successm').removeClass('d-none');
                $("#st_message").html("<p> Images were uploaded!</p>");
                window.setTimeout(function() {
                    location.reload()
                }, 3000)
            },
            error: function(file, response) {
                return false;
            }
        };
    </script>
    <script>
        $('.js-validation-vehicle-colors').validate({
            ignore: "",
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: (error, e) => {
                $(e).parents('.form-group > div').append(error);
            },
            highlight: e => {
                $(e).closest('.form-group > div').removeClass('is-invalid').addClass('is-invalid');
            },
            success: e => {
                $(e).closest('.form-group > div').removeClass('is-invalid');
                $(e).remove();
            }
        });
        $('.colorpicker').colorpicker();
    </script>
@endsection
@section('css_after')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css"
        rel="stylesheet">
@endsection
