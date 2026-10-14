@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Locations Content</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.location_content.index') }}">Locations Content</a>
        <span class="breadcrumb-item active">Add</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add Locations Content</h3>
        </div>

        <div class="alert alert-warning" role="alert">
            <h5><small> Please type </small> <b>[location]</b><small> for replacing the location name.</small></h5>
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
            <form class="js-validation-vehicles" action="{{ route('admin.location_content.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 @error('content') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="content" name="content" rows="2"
                                placeholder="Please provide content for the vehicle">{{ @old('content',@$location_content->content) }}</textarea>
                            <label for="content">Content</label>
                        </div>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
                    @if(@$location_content->banner_image)
                    <div class="col-md-6">
                        <img src="{{ asset('storage/'.$location_content->banner_image) }}"  alt="Everest"
                        width="250px">
                    </div>
                    @endif
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
                    @if(@$location_content->image)
                    <div class="col-md-6">
                        <img src="{{ asset('storage/'.$location_content->image) }}"  alt="Everest" width="250px">
                    </div>
                    @endif
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
</script>
@endsection
