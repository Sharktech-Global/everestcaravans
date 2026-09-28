@extends('admin.layouts.app')

@section('content')
<div class="content">

    
    <h2 class="content-heading">Abreco Group</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.about-group.index') }}">Abreco Group</a>
        <span class="breadcrumb-item active">Update</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Update Abreco Group</h3>
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
            <form class="js-validation-contact-page" action="{{ route('admin.about-group.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">About Group Settings</h3>
                    </div>
                    <div class="block-content">

                        <div class="form-group row">
                            <div class="col-md-6 @error('title') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ @$page->title }}" placeholder="Please provide title "
                                        >
                                    <label for="title">Title<span style="color:red;">*</span></label>
                                </div>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 @error('sub_title') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control" id="sub_title" name="sub_title"
                                        value="{{ @$page->sub_title }}" placeholder="Please provide sub title"
                                        >
                                    <label for="sub_title">Sub title</label>
                                </div>
                                @error('sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 @error('location_title') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control" id="location_title" name="location_title"
                                        value="{{ @$page->location_title }}" placeholder="Please provide location title"
                                        >
                                    <label for="location_title">Location title</label>
                                </div>
                                @error('location_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 @error('link') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control" id="link" name="link"
                                        value="{{ @$page->link }}" placeholder="Please provide Video Link"
                                        >
                                    <label for="link">Video Link</label>
                                </div>
                                @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 @error('content') is-invalid @enderror">
                                <div class="form-material">
                                    <textarea class="form-control summernote" id="content"
                                        name="content">{{ @old('content',@$page->content) }}</textarea>
                                    <label for="content">Content<span style="color:red;">*</span></label>
                                </div>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 @error('sub_content') is-invalid @enderror">
                                <div class="form-material">
                                    <textarea class="form-control summernote" id="sub_content"
                                        name="sub_content">{{ @old('sub_content',@$page->sub_content) }}</textarea>
                                    <label for="sub_content">Sub Content</label>
                                </div>
                                @error('sub_content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 @error('location_content') is-invalid @enderror">
                                <div class="form-material">
                                    <textarea required class="form-control summernote" id="location_content"
                                        name="location_content">{{ @old('location_content',@$page->location_content) }}</textarea>
                                    <label for="location_content">Location Content</label>
                                </div>
                                @error('location_content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                           
                            <div class="col-md-6 @error('banner_image') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="file" id="banner_image" name="banner_image">
                                    <label for="banner_image">Banner Image</label><br>
                                    dimension( 1920 × 686px)
                                    width-526 height-188
                                    @if(@$page->banner_image)
                                    <img alt="abreco" src="{{ asset('storage/'.@$page->banner_image) }}"
                                        style="width: 200px;margin: 15px 0;">
                                    @endif
                                </div>
                                @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                           
                            <div class="col-md-6 @error('mobile_banner') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="file" id="mobile_banner" name="mobile_banner">
                                    <label for="mobile_banner">Mobile Banner</label><br>
                                    dimension( 1920 × 686px)
                                    width-526 height-188
                                    @if(@$page->mobile_banner)
                                    <img alt="abreco" src="{{ asset('storage/'.@$page->mobile_banner) }}"
                                        style="width: 200px;margin: 15px 0;">
                                    @endif
                                </div>
                                @error('mobile_banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 @error('content_image_one') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="file" id="content_image_one" name="content_image_one">
                                    <label for="content_image_one">Content Image - Primary</label><br>
                                    dimension( 1920 × 686px)<br>
                                    width-526 height-188
                                    @if(@$page->content_image_one)
                                    <img alt="abreco" src="{{ asset('storage/'.@$page->content_image_one) }}"
                                    style="width: 200px;margin: 15px 0;">
                                    @endif
                                </div>
                                @error('content_image_one')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 @error('content_image_two') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="file" id="content_image_two" name="content_image_two">
                                    <label for="content_image_two">Content Image - Secondary</label><br>
                                    dimension( 1920 × 686px)<br>
                                    width-526 height-188
                                    @if(@$page->content_image_two)
                                    <img alt="abreco" src="{{ asset('storage/'.@$page->content_image_two) }}"
                                    style="width: 200px;margin: 15px 0;">
                                    @endif
                                </div>
                                @error('content_image_two')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 @error('content_image_three') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="file" id="content_image_three" name="content_image_three">
                                    <label for="content_image_three">Content Image - Tertiary</label><br>
                                    dimension( 1920 × 686px)<br>
                                    width-526 height-188
                                    @if(@$page->content_image_three)
                                    <img alt="abreco" src="{{ asset('storage/'.@$page->content_image_three) }}"
                                    style="width: 200px;margin: 15px 0;">
                                    @endif
                                </div>
                                @error('content_image_three')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <!-- seo -->
                {{-- <div class="block">
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
                </div> --}}

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
