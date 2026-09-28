@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">News And Events Settings</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.news-events.index') }}">News And Events Settings</a>
    </nav>
    <div class="block">
        
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
            <form class="js-validation-contact-page" action="{{ route('admin.news-events.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">News And Events Settings</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-md-12 @error('title') is-invalid @enderror">
                                <div class="form-material">
                                    <input required type="text" class="form-control" value="{{ @old('title',@$page->title) }}" id="title" name="title" rows="2"
                                        placeholder="Please provide title for the vehicle feature">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                </div>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 @error('sub_title') is-invalid @enderror">
                                <div class="form-material">
                                    <input  type="text" class="form-control" value="{{ @old('sub_title',@$page->sub_title) }}" id="sub_title" name="sub_title" rows="2"
                                        placeholder="Please provide sub_title for the vehicle feature">
                                    <label for="sub_title">Subtitle</label>
                                </div>
                                @error('sub_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 @error('content') is-invalid @enderror">
                                <div class="form-material">
                                    <textarea class="form-control summernote" id="content"
                                        name="content">{{ @old('content',@$page->content) }}</textarea>
                                    <label for="content">Content</label>
                                </div>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 @error('banner_image') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="file" id="banner_image" name="banner_image">
                                    <label for="banner_image">Banner Image</label>
                                    @if(@$page->banner_image)
                                    <img alt="Abreco" src="{{ asset('storage/'.@$page->banner_image) }}"
                                        style="width: 200px;margin: 15px 0;">
                                    @endif
                                </div>
                                @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       

                    </div>
                </div>
                <div class="block-header block-header-default">
                    <h3 class="block-title">SEO  Settings</h3>
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
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                        value="{{ @$page->seo_title }}" placeholder="Please provide seo title "
                                        >
                                    <label for="seo_title">Seo Title</label>
                                </div>
                                @error('seo_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 @error('seo_keywords') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control" id="seo_keywords" name="seo_keywords"
                                        value="{{ @$page->seo_keywords }}" placeholder="Please provide seo keywords "
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
                                    <input type="text" class="form-control" id="seo_description" name="seo_description"
                                        value="{{ @$page->seo_description }}"
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
    $('.js-validation-contact-page').validate({
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
