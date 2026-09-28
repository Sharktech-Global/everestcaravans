@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Services</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.services.index') }}">Services</a>
        <span class="breadcrumb-item active">Add</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add Services</h3>
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
            <form class="js-validation-vehicles" action="{{ route('admin.services.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 @error('title') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Please provide title" value="{{ @old('title') }}" required>
                            <label for="title">Title<span style="color:red;">*</span></label>
                        </div>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('sub_title') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Please provide sub title" value="{{ @old('title') }}">
                            <label for="title">Sub Title</label>
                        </div>
                        @error('sub_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('content') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="content" name="content" rows="2" placeholder="Please provide content">{{ @old('content') }}</textarea>
                            <label for="content">Content</label>
                        </div>
                        @error('content')
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
                    <div class="col-md-6 @error('banner_image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="banner_image" name="banner_image">
                            <label for="banner_image">Banner Image</label>
                        </div>
                        @error('banner_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('mobile_image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="mobile_image" name="mobile_image">
                            <label for="mobile_image">Mobile Image</label>
                        </div>
                        @error('mobile_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 @error('order') is-invalid @enderror">
                        <div class="form-material">
                            <input type="number" min="1" class="form-control" id="order" name="order"
                                placeholder="Please provide order"
                                value="{{ @old('order') }}" required>
                            <label for="order">Order<span class="text-danger">*</span></label>
                        </div>
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('status') is-invalid @enderror p-0">
                        <label class="col-12">Status</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status1" value="1" @if (!@old('status')) checked @endif>
                                <label class="custom-control-label" for="status1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="0" @if (@old('status')) checked @endif>
                                <label class="custom-control-label" for="status2">No</label>
                            </div>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                   <!-- seo -->
                   <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Seo</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-md-6 @error('seo_title') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control"  id="seo_title" name="seo_title"
                                    value="{{ @old('seo_title') }}" placeholder="Please provide seo title "
                                        >
                                    <label for="seo_title">Seo Title</label>
                                </div>
                                @error('seo_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 @error('seo_keywords') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control"  id="seo_keywords" name="seo_keywords"
                                    value="{{ @old('seo_keywords') }}" placeholder="Please provide seo keywords "
                                        >
                                    <label for="seo_keywords">Seo Keywords</label>
                                </div>
                                @error('seo_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 @error('seo_description') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control"   id="seo_description" name="seo_description"
                                        value="{{ @old('seo_description') }}"
                                        placeholder="Please provide seo description " >
                                    <label for="seo_description">Seo Description</label>
                                </div>
                                @error('seo_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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