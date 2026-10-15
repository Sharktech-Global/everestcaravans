@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">GO RV Reviews</h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.news-events-list.index') }}">GO RV Reviews</a>
            <span class="breadcrumb-item active">{{$list->title}}</span>
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
                <form class="js-validation-vehicle-features" action="{{ route('admin.news-events-list.update',$list->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <input required type="text" class="form-control" value="{{ @old('title',@$list->title) }}" id="title" name="title" rows="2"
                                    placeholder="Please provide title for the vehicle feature">
                                <label for="title">Title <span class="text-danger">*</span></label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('sub_title') is-invalid @enderror">
                            <div class="form-material">
                                <input  type="text" class="form-control" value="{{ @old('sub_title',@$list->title) }}" id="sub_title" name="sub_title" rows="2"
                                    placeholder="Please provide sub_title for the vehicle feature">
                                <label for="sub_title">Sub Title </label>
                            </div>
                            @error('sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('content') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="details" name="content" rows="2"
                                    placeholder="Please provide details for the vehicle">{{ @old('details',@$list->content) }}</textarea>
                                <label for="details">Details</label>
                            </div>
                            @error('details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="image" name="image" multiple>
                                <label for="image">Image </label><br>
                                dimension(700 × 500px)
                                width- 263 , height- 188
                                @if($list->image)
                                    <img height="100px" src="{{asset('storage/'.$list->image)}}">
                                @endif
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                      
                        <div class="col-md-6 @error('date_of_event') is-invalid @enderror">
                            <div class="form-material">
                                <input type="date" class="form-control" value="{{ @old('date_of_event',@$list->date_of_event) }}" id="date_of_event" name="date_of_event">
                                <label for="date_of_event">Date</label>
                            </div>
                            @error('date_of_event')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                        @if (@old('status', $list->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (!@old('status', $list->status)) checked @endif>
                                    <label class="custom-control-label" for="status2">No</label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
