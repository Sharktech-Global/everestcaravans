@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Images</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.editions.index',$vehicle->id) }}">Editions</a>

        <a class="breadcrumb-item" href="{{ route('admin.vehicles.editions.sections.index',[$vehicle->id,$EditionSection->id]) }}">Sections</a>
        <a class="breadcrumb-item"
            href="{{ route('admin.vehicles.editions.sections.images.index',[$VehicleEdition->id,$EditionSection->id]) }}">Images</a>
        <span class="breadcrumb-item active">Edit</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Image</h3>
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
            <form class="js-validation-vehicle-images"
                action="{{ route('admin.vehicles.editions.sections.images.update',[$EditionSection->id,$image->id]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-12 @error('title') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Please provide title of image"
                                value="{{ @old('title',$image->title) }}">
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
                                placeholder="Please provide description for the image">{{ @old('description',$image->description) }}</textarea>
                            <label for="description">Description</label>
                        </div>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('order') is-invalid @enderror">
                        <div class="form-material">
                            <input type="number" min="1" class="form-control" id="order" name="order"
                                placeholder="Please provide order of image"
                                value="{{ @old('order',$image->order) }}" required>
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
                        <img src="{{ asset('storage/'.$image->image) }}"  alt="Abreco"
                        width="250px">
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
    $('.js-validation-vehicle-images').validate({
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
