@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Vehicles</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.editions.index', $vehicle->id) }}">Editions</a>
            <span class="breadcrumb-item active">Add Edition</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Edition</h3>
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
                <form class="js-validation-vehicle-sections"
                    action="{{ route('admin.vehicles.editions.store', $vehicle->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <textarea required class="form-control" id="title" name="title" rows="2"
                                    placeholder="Please provide title for the vehicle">{{ @old('title') }}</textarea>
                                <label for="title">Title <span class="text-danger">*</span></label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('description') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="description" name="description" rows="2"
                                    placeholder="Please provide description for the vehicle">{{ @old('description') }}</textarea>
                                <label for="description">Description</label>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 @error('image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="image" name="image" required>
                                <label for="image">Image <span class="text-danger">*</span></label>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 @error('thumb') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="thumb" name="thumb">
                                <label for="thumb">Thumb</label>
                            </div>
                            @error('thumb')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 @error('background_image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="background_image" name="background_image">
                                <label for="background_image">Background Image</label>
                            </div>
                            @error('background_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 @error('brochure') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="brochure" name="brochure">
                                <label for="brochure">Brochure</label>
                            </div>
                            @error('brochure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-3 @error('order_number') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="order_number" name="order_number"
                                    placeholder="Please provide booking amount for the vehicle"
                                    value="{{ @old('order_number') }}" required>
                                <label for="order_number">Order <span class="text-danger">*</span></label>
                            </div>
                            @error('order_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 @error('booking_amount') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="booking_amount" name="booking_amount"
                                    placeholder="Please provide booking amount for the vehicle"
                                    value="{{ @old('booking_amount') }}" required>
                                <label for="booking_amount">Booking Amount <span class="text-danger">*</span></label>
                            </div>
                            @error('booking_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 @error('is_booking') is-invalid @enderror p-0">
                            <label class="col-12">Booking Active?</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_booking" id="is_booking1"
                                        value="1" @if (@old('is_booking')) checked @endif>
                                    <label class="custom-control-label" for="is_booking1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_booking" id="is_booking2"
                                        value="0" @if (!@old('is_booking')) checked @endif>
                                    <label class="custom-control-label" for="is_booking2">No</label>
                                </div>
                                @error('is_booking')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                        @if (!@old('status')) checked @endif>
                                    <label class="custom-control-label" for="status1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (@old('status')) checked @endif>
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
        $('.js-validation-vehicle-sections').validate({
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
    </script>
@endsection
