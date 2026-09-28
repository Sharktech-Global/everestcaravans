@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">SEO</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
        {{-- <a class="breadcrumb-item" href="{{ route('vehicles.show',$vehicle->slug) }}"
            target="_blank">{{ $vehicle->name }}</a> --}}
        <span class="breadcrumb-item active">SEO</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Update SEO</h3>
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
            <form class="js-validation-vehicles-seo" action="{{ route('admin.vehicles.seo.store',$vehicle->id) }}"
                method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 @error('title') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Please provide the meta title" value="{{ @old('title',$seo->title) }}"
                                required>
                            <label for="title">Meta Title</label>
                        </div>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('description') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control" id="description" name="description" rows="2"
                                placeholder="Please provide meta description"
                                required>{{ @old('description',$seo->description) }}</textarea>
                            <label for="description">Meta Description</label>
                        </div>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('keywords') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control" id="keywords" name="keywords" rows="2"
                                placeholder="Please provide meta keywords"
                                required>{{ @old('keywords',$seo->keywords) }}</textarea>
                            <label for="keywords">Meta Keywords <small>Seperated by comma</small></label>
                        </div>
                        @error('keywords')
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
    $('.js-validation-vehicles-seo').validate({
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
