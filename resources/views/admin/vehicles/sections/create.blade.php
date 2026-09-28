@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Vehicles</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
            <a class="breadcrumb-item" href="#"
                target="_blank">{{ $vehicle->name }}</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.sections.index', $vehicle->id) }}">Sections</a>
            <span class="breadcrumb-item active">Add Section</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Section</h3>
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
                    action="{{ route('admin.vehicles.sections.store', $vehicle->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="title" name="title"
                                    placeholder="Please provide title of description" value="{{ @old('title') }}"
                                    required></textarea>
                                <label for="title">Title</label>
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
                                    placeholder="Please provide description for the section">{{ @old('description') }}</textarea>
                                <label for="description">Description</label>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 @error('order') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="order" name="order"
                                    placeholder="Please provide order of section" value="{{ @old('order') }}" required>
                                <label for="order">Order</label>
                            </div>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('has_tab') is-invalid @enderror p-0" style="display:none;">
                            <label class="col-12">Does detail have a tab view?</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="has_tab" id="has_tab1" value="1"
                                        @if (!@old('has_tab')) checked @endif
                                        required>
                                    <label class="custom-control-label" for="has_tab1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="has_tab" id="has_tab2" value="0"
                                        @if (@old('has_tab')) checked @endif
                                        required>
                                    <label class="custom-control-label" for="has_tab2">No</label>
                                </div>
                                @error('has_tab')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 @error('background') is-invalid @enderror p-0" style="display:none;">
                            <label class="col-12">Background Color</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="background" id="background1"
                                        value="white" @if (!@old('background') == 'white') checked @endif required>
                                    <label class="custom-control-label" for="background1">White</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="background" id="background2"
                                        value="black" @if (@old('background') == 'black') checked @endif required>
                                    <label class="custom-control-label" for="background2">Black</label>
                                </div>
                                @error('background')
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
