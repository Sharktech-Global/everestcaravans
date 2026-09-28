@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Features</h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.show',$vehicle->id) }}"
                target="_blank">{{ $vehicle->name }}</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.features.index',$vehicle->id) }}">Features</a>
            <span class="breadcrumb-item active">{{$vehicleFeature->title}}</span>
        </nav>
        <div class="block">
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
                <form class="js-validation-vehicle-features" action="{{ route('admin.vehicles.features.update',[$vehicle->id,$vehicleFeature->id]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <input required type="text" class="form-control" value="{{ @old('title',$vehicleFeature->title) }}" id="title" name="title" rows="2"
                                    placeholder="Please provide title for the vehicle feature">
                                <label for="title">Title <span class="text-danger">*</span></label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('subtitle') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" value="{{ @old('subtitle',$vehicleFeature->subtitle) }}" id="subtitle" name="subtitle" rows="2"
                                    placeholder="Please provide subtitle for the vehicle feature">
                                <label for="subtitle">Subtitle</label>
                            </div>
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('details') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="details" name="details" rows="2"
                                    placeholder="Please provide details for the vehicle">{{ @old('details',$vehicleFeature->details) }}</textarea>
                                <label for="details">Details</label>
                            </div>
                            @error('details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 @error('images') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="images" name="images[]" multiple>
                                <label for="images">Images <span class="text-danger">*</span></label>
                                @if($vehicleFeature->image_files)
                                    @foreach ($vehicleFeature->image_files as $file)
                                        <div class="row">
                                            <div class="col-6">
                                                <img src="{{asset('storage/'.@$file->image)}}" width="200px;" >
                                            </div>  
                                            <div class="col-6">
                                                <button type="button" onclick="update_data('{{@$file->id}}')" class="btn btn-sm btn-secondary" title="Delete">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>  
                                        </div>  
                                    @endforeach
                                @endif
                            </div>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row items-push-2x text-center text-sm-right">
                            <div class="col-sm-12 col-xl-12 mb-20">
                                <button type="submit" class="btn btn-primary min-width-125">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js_after')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#vehicle_type').select2({
                placeholder: 'Please select a vehicle type',
                width: '100%',
                allowClear: true
            });

        });
        $('.js-validation-vehicles').validate({
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

    function update_data(id){
        if(confirm('Are you sure to delete this vehicle feature image?')){
            var url = "{{ route('admin.vehicles.features_image.destroy', ':id') }}";
            url = url.replace(':id', id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            type: 'GET',
            url: url,
            data: {
                id: "id",
            },
            success: function(response) {
                if(response.status == "success"){
                        swal("success!", "Image deleted successfully!", "success")
                      }
                      else{
                        sweetAlert("Oops...", "Something went wrong!", "error");
                      }
                      location.reload()
            }
        });
        }
      
    }
    </script>
@endsection
