@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Home Slider</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.home-slider.index') }}">Home Slider</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Home Slider</h3>
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
                <form class="js-validation-home-slider" action="{{ route('admin.home-slider.update', $homeSlider->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="commercial" name="type">

                    {{-- <div class="form-group row">
                        <div class="col-md-12 @error('type') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="type" name="type" required>
                                    <option></option>
                                    <option value="arena" @if (@old('type', $homeSlider->type) == 'arena') selected @endif>Arena</option>
                                    <option value="nexa" @if (@old('type', $homeSlider->type) == 'nexa') selected @endif>Nexa</option>
                                </select>
                                <label for="type">Vehicle Category</label>
                            </div>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <div class="col-md-12 @error('description') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="description" name="description"
                                    required>{{ @old('description', $homeSlider->description) }}</textarea>
                                <label for="description">Description</label>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row @if (@old('type', $homeSlider->type) != 'nexa') d-none @endif" id="nexa-box">
                        <div class="col-md-6 @error('booking') is-invalid @enderror">
                            <div class="form-material">
                                <input type="url" class="form-control" value="{{ @old('booking', $homeSlider->booking) }}"
                                    id="booking" name="booking" @if (@old('type', $homeSlider->type) == 'nexa') required @endif>
                                <label for="booking">Booking Link</label>
                            </div>
                            @error('booking')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('explore') is-invalid @enderror">
                            <div class="form-material">
                                <input type="url" class="form-control"
                                    value="{{ @old('explore', $homeSlider->explore) }}" id="explore" name="explore" @if (@old('type', $homeSlider->type) == 'nexa') required @endif>
                                <label for="explore">Explore Link</label>
                            </div>
                            @error('explore')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row " id="arena-box">
                        <div class="col-md-12 @error('vehicle') is-invalid @enderror">
                            <div class="form-material">
                                <select required class="form-control" id="vehicle" name="vehicle">
                                    <option></option>
                                    @foreach ($vehicles as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('vehicle', $homeSlider->vehicle_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="vehicle">Vehicle<span aria-hidden="true">×</span></label>
                            </div>
                            @error('vehicle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('image') is-invalid @enderror">
                            <label for="image">width-368, height- 188</label>

                            <div class="form-material">
                                <input type="file" id="image" name="image">
                                <label for="image">Image dimension (1920 × 980 px)</label>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $homeSlider->image) }}"  alt="Abreco" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('mobile_image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="mobile_image" name="mobile_image">
                                <label for="mobile_image">Mobile_image  dimension (1920 × 980 px)</label>
                            </div>
                            <label for="image">width-368, height- 188</label>

                            @error('mobile_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $homeSlider->mobile_image) }}"  alt="Abreco" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control " value="{{@$homeSlider->title}}" id="title" name="title">
                                <label for="title">Title</label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="col-md-6">
                            <img src="{{ asset('storage/' . $homeSlider->title) }}"  alt="Abreco" width="250px"
                                style="background-color: black;padding: 10px;">
                        </div>  --}}
                         <div class="col-md-4 @error('sub_title') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" value="{{@$homeSlider->sub_title}}" id="sub_title" name="sub_title">
                                <label for="sub_title">Sub Title</label>
                            </div>
                            @error('sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                        @if (@old('status', $homeSlider->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Active</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (!@old('status', $homeSlider->status)) checked @endif>
                                    <label class="custom-control-label" for="status2">Inactive</label>
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
                var type = 'commercial';
                if (type == 'commercial') {
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
                    $("#vehicle").val('').trigger('change');
                } else {
                    $('#vehicle').attr('required', false);
                    $('#booking').attr('required', false);
                    $('#explore').attr('required', false);
                    $('#arena-box').addClass('d-none');
                    $('#nexa-box').addClass('d-none');
                    $("#vehicle").val('').trigger('change');
                }
            });
        });
        $('.js-validation-home-slider').validate({
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
