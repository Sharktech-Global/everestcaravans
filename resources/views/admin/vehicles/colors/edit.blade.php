@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Vehicle Colors</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
            <a class="breadcrumb-item" href="#"
                target="_blank">{{ $vehicle->name }}</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.colors.index', $vehicle->id) }}">Colors</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Color</h3>
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
                <form class="js-validation-vehicles-colors"
                    action="{{ route('admin.vehicles.colors.update', [$vehicle->id, $vehicleColor->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-12 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Please provide name of color"
                                    value="{{ @old('name', $vehicleColor->name) }}" required>
                                <label for="name">Name</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 @error('color.1') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control colorpicker" id="color-1" name="color[1]"
                                    placeholder="Please provide color"
                                    value="{{ @old('color.1', $vehicleColor->color[1]) }}" required>
                                <label for="color">Color 1</label>
                            </div>
                            @error('color.1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('color.2') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control colorpicker" id="color-2" name="color[2]"
                                    placeholder="Please provide color"
                                    value="{{ @old('color.2', $vehicleColor->color[2]) }}">
                                <label for="color">Color 2</label>
                            </div>
                            @error('color.2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('order') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="order" name="order"
                                    placeholder="Please provide order of color"
                                    value="{{ @old('order', $vehicleColor->order) }}" required>
                                <label for="order">Order</label>
                            </div>
                            @error('order')
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
                            <img src="{{ asset('storage/' . $vehicleColor->image) }}"  alt="Abreco" width="250px">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js">
    </script>
    <script>
        $('.js-validation-vehicles-colors').validate({
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
