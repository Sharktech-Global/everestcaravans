@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Vehicles</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Vehicle</h3>
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
                <form class="js-validation-vehicles" action="{{ route('admin.vehicles.update', $vehicle->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-6 @error('vehicle_type') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                                    <option></option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('vehicle_type', $vehicle->vehicle_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="vehicle_type">Vehicle Type <span class="text-danger">*</span></label>
                            </div>
                            @error('vehicle_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('application') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="application" name="application" required>
                                    <option></option>
                                    @foreach ($applications as $application)
                                        <option value="{{ $application->id }}"
                                            {{ old('application', $vehicle->application_id) == $application->id ? 'selected' : '' }}>
                                            {{ $application->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="application">Vehicle Application <span class="text-danger">*</span></label>
                            </div>
                            @error('application')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Please provide name of the vehicle"
                                    value="{{ @old('name', $vehicle->name) }}" required>
                                <label for="name">Name <span class="text-danger">*</span></label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control" id="title" name="title" rows="2"
                                    placeholder="Please provide title for the vehicle">{{ @old('title', $vehicle->title) }}</textarea>
                                <label for="title">Title</label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('tagline') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="tagline" name="tagline" rows="2"
                                    placeholder="Please provide tagline for the vehicle">{{ @old('tagline', $vehicle->tagline) }}</textarea>
                                <label for="tagline">Tagline</label>
                            </div>
                            @error('tagline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="image" name="image">
                                <label for="image">Image</label>
                            </div>
                            dimension(657 × 465px)<br>
                            <label for="image">width- 265, height- 188</label>


                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $vehicle->image) }}"  alt="Everest" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('thumb') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="thumb" name="thumb">
                                <label for="thumb">Menu Image</label>
                            </div>
                            dimension(435 × 640px)<br>
                            <label for="image">width- 127, height- 188</label>


                            @error('thumb')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $vehicle->thumb) }}"  alt="Everest" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('banner_image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="banner_image" name="banner_image">
                                <label for="banner_image">Banner Image</label>
                            </div>
                            dimension(1920 × 686 px)<br>
                            <label for="image">width- 526, height- 188</label>


                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $vehicle->banner_image) }}"  alt="Everest" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('online_image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="online_image" name="online_image">
                                <label for="online_image">Book Online Image</label>
                            </div>
                            dimension(500 × 360 px)<br>
                            <label for="image">width- 261, height- 188</label>


                            @error('online_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $vehicle->online_image) }}"  alt="Everest" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('mobile_banner') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="mobile_banner" name="mobile_banner">
                                <label for="mobile_banner">Mobile Banner</label>

                            </div>
                            dimension(658 × 878 px)<br>

                            <label for="image">width- 140, height- 188</label>

                            @error('mobile_banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $vehicle->mobile_banner) }}"  alt="Everest" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 @error('order') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="order" name="order"
                                    placeholder="Please provide order"
                                    value="{{ @old('order',$vehicle->order) }}" required>
                                <label for="order">Order<span class="text-danger">*</span></label>
                            </div>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('brochure') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" value="{{$vehicle->brochure}}" type="text" id="brochure" name="brochure">
                                <label for="brochure">Brochure</label>
                            </div>
                            @error('brochure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <a target="_blank" href="{{ $vehicle->brochure }}"
                                class="btn btn-alt-secondary">View
                                Brochure</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 @error('booking_amount') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="booking_amount" name="booking_amount"
                                    placeholder="Please provide booking amount for the vehicle"
                                    value="{{ @old('booking_amount', $vehicle->booking_amount) }}" required>
                                <label for="booking_amount">Booking Amount <span class="text-danger">*</span></label>
                            </div>
                            @error('booking_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('is_booking') is-invalid @enderror p-0">
                            <label class="col-12">Booking Active?</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_booking" id="is_booking1"
                                        value="1" @if (@old('is_booking', $vehicle->is_booking)) checked @endif>
                                    <label class="custom-control-label" for="is_booking1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_booking" id="is_booking2"
                                        value="0" @if (!@old('is_booking', $vehicle->is_booking)) checked @endif>
                                    <label class="custom-control-label" for="is_booking2">No</label>
                                </div>
                                @error('is_booking')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                        @if (@old('status', $vehicle->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (!@old('status', $vehicle->status)) checked @endif>
                                    <label class="custom-control-label" for="status2">No</label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-alt-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js_after')
    <script>
        $('#vehicle_type').select2({
                placeholder: 'Please select a vehicle type',
                width: '100%',
                allowClear: true
            });

            $('#application').select2({
                placeholder: 'Please select a vehicle application',
                width: '100%',
                allowClear: true
            });

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
        $('#vehicle_type').on('change', function() {
                var type_id = this.value;
                $("#application").html('');
                $.ajax({
                    url: "{{ route('admin.vehicles.fetchvehicle') }}",
                    type: "POST",
                    data: {
                        type_id: type_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        $('#application').html(
                            '<option value="">Please select a vehicle application</option>');
                        $.each(result, function(key, value) {
                            $("#application").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
    </script>
@endsection
