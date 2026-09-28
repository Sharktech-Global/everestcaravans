@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Vehicles</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.editions.index', $vehicle->id) }}">Editions</a>
            <span class="breadcrumb-item active">Edit Edition</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Edition</h3>
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
                    action="{{ route('admin.vehicles.editions.update', [$vehicle->id, $edition->id]) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-12 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <textarea required class="form-control" id="title" name="title" rows="2"
                                    placeholder="Please provide title for the vehicle">{{ @old('title',$edition->title) }}</textarea>
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
                                    placeholder="Please provide description for the vehicle">{{ @old('description',$edition->description) }}</textarea>
                                <label for="description">Description</label>
                            </div>
                            @error('description')
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
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $edition->image) }}"  alt="Abreco" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('thumb') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="thumb" name="thumb">
                                <label for="thumb">Thumb Image</label>
                            </div>
                            @error('thumb')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if($edition->thumb)
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $edition->thumb) }}"  alt="Abreco" width="250px">
                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('banner_image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="banner_image" name="banner_image">
                                <label for="banner_image">Banner Image</label>
                            </div>
                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if($edition->banner_image)
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $edition->banner_image) }}"  alt="Abreco" width="250px">
                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('brochure') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="brochure" name="brochure">
                                <label for="brochure">Brochure</label>
                            </div>
                            @error('brochure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if($edition->brochure)
                            <div class="col-md-6">
                                <a target="_blank" href="{{ asset('storage/' . $edition->brochure) }}"
                                    class="btn btn-alt-secondary">View
                                    Brochure</a>
                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 @error('order_number') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="order_number" name="order_number"
                                    placeholder="Please provide booking amount for the section"
                                    value="{{ @old('order_number', $edition->order) }}" required>
                                <label for="order_number">Order</label>
                            </div>
                            @error('order_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 @error('booking_amount') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="booking_amount" name="booking_amount"
                                    placeholder="Please provide booking amount for the vehicle"
                                    value="{{ @old('booking_amount', $edition->booking_amount) }}" required>
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
                                        value="1" @if (@old('is_booking', $edition->is_booking)) checked @endif>
                                    <label class="custom-control-label" for="is_booking1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_booking" id="is_booking2"
                                        value="0" @if (!@old('is_booking', $edition->is_booking)) checked @endif>
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
                                        @if (@old('status', $edition->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (!@old('status', $edition->status)) checked @endif>
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
