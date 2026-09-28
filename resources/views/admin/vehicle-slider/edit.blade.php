@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Home Vehicle Slider</h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicle-slider.index') }}">Home Vehicle Slider</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Home Vehicle Slider</h3>
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
                <form class="js-validation-vehicle-slider"
                    action="{{ route('admin.vehicle-slider.update', $slider->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-6 @error('type') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="type" name="type" required>
                                    <option></option>
                                    <option value="arena" @if (@old('type', $slider->type) == 'arena') selected @endif>Arena</option>
                                    <option value="nexa" @if (@old('type', $slider->type) == 'nexa') selected @endif>Nexa</option>
                                </select>
                                <label for="type">Vehicle Category</label>
                            </div>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" name="name" class="form-control"
                                    value="{{ @old('name', $slider->name) }}" required>
                                <label for="name">Name</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('description') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="description" name="description"
                                    required>{{ @old('description', $slider->description) }}</textarea>
                                <label for="description">Description</label>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('logo') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="logo" name="logo">
                                <label for="logo">Logo</label>
                            </div>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $slider->logo) }}"  alt="Abreco" width="250px">
                        </div>
                        <div class="col-md-6 @error('image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="image" name="image">
                                <label for="image">Main Image</label>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $slider->image) }}"  alt="Abreco" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('thumb1') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="thumb1" name="thumb1">
                                <label for="thumb1">Thumb Image 1</label>
                            </div>
                            @error('thumb1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $slider->thumb1) }}"  alt="Abreco" width="250px">
                        </div>
                        <div class="col-md-6 @error('thumb2') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="thumb2" name="thumb2">
                                <label for="thumb2">Thumb Image 2</label>
                            </div>
                            @error('thumb2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $slider->thumb2) }}"  alt="Abreco" width="250px">
                        </div>
                    </div>

                    <div class="form-group row @if (@old('type', $slider->type) != 'nexa') d-none @endif" id="nexa-box">
                        <div class="col-md-6 @error('booking') is-invalid @enderror">
                            <div class="form-material">
                                <input type="url" class="form-control" value="{{ @old('booking', $slider->booking) }}"
                                    id="booking" name="booking" @if (@old('type', $slider->type) == 'nexa') required @endif>
                                <label for="booking">Booking Link</label>
                            </div>
                            @error('booking')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('explore') is-invalid @enderror">
                            <div class="form-material">
                                <input type="url" class="form-control" value="{{ @old('explore', $slider->explore) }}"
                                    id="explore" name="explore" @if (@old('type', $slider->type) == 'nexa') required @endif>
                                <label for="explore">Explore Link</label>
                            </div>
                            @error('explore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row @if (@old('type', $slider->type) != 'arena') d-none @endif" id="arena-box">
                        <div class="col-md-12 @error('vehicle') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="vehicle" name="vehicle" @if (@old('type', $slider->type) == 'arena') required @endif>
                                    <option></option>
                                    @foreach ($vehicles as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('vehicle', $slider->vehicle_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="vehicle">Vehicle</label>
                            </div>
                            @error('vehicle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                        @if (@old('status', $slider->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Active</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (!@old('status', $slider->status)) checked @endif>
                                    <label class="custom-control-label" for="status2">Inactive</label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 @error('order') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="order" name="order"
                                    placeholder="Please provide order of vehicle type"
                                    value="{{ @old('order', $slider->order_id) }}" required>
                                <label for="order">Order</label>
                            </div>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
        $(document).ready(function() {
            $('#vehicle').select2({
                placeholder: 'Choose Vehicle',
                width: '100%',
                allowClear: true
            });
            $('#type').select2({
                placeholder: 'Choose Category',
                width: '100%',
                allowClear: true
            });
            $('#type').on('change', function(e) {
                var type = this.value;
                if (type == 'arena') {
                    $('#vehicle').attr('required', true);
                    $('#booking').attr('required', false);
                    $('#explore').attr('required', false);
                    $('#arena-box').removeClass('d-none');
                    $('#nexa-box').addClass('d-none');

                } else if (type == 'nexa') {
                    $('#vehicle').attr('required', false);
                    $('#booking').attr('required', true);
                    $('#explore').attr('required', true);
                    $('#arena-box').addClass('d-none');
                    $('#nexa-box').removeClass('d-none');
                } else {
                    $('#vehicle').attr('required', false);
                    $('#booking').attr('required', false);
                    $('#explore').attr('required', false);
                    $('#arena-box').addClass('d-none');
                    $('#nexa-box').addClass('d-none');
                }
            });
        });
        $('.js-validation-vehicle-slider').validate({
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
