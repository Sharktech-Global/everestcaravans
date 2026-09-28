@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">{{ $title }}</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <span class="breadcrumb-item active">{{ $title }}</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
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
                <form class="js-validation-insurance-feature-page"
                    action="{{ route('admin.insurance-page.store', $slug) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ @old('title', $page->title) }}" placeholder="Please provide title "
                                    required>
                                <label for="title">Title</label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('content') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="content" name="content"
                                    required>{{ @old('content', $page->content) }}</textarea>
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
                        @if ($page->banner_image)
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $page->banner_image) }}"  alt="Abreco" width="250px">
                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('background_image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="background_image" name="background_image">
                                <label for="background_image">Background Image</label>
                            </div>
                            @error('background_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if ($page->background_image)
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $page->background_image) }}"  alt="Abreco" width="250px">
                            </div>
                        @endif
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
                                            value="{{ old('seo_title', $page->seo_title) }}"
                                            placeholder="Please provide seo title " required>
                                        <label for="seo_title">Seo Title</label>
                                    </div>
                                    @error('seo_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 @error('seo_keywords') is-invalid @enderror">
                                    <div class="form-material">
                                        <input type="text" class="form-control" id="seo_keywords" name="seo_keywords"
                                            value="{{ old('seo_keywords', $page->seo_keywords) }}"
                                            placeholder="Please provide seo keywords " required>
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
                                        <input type="text" class="form-control" id="seo_description"
                                            name="seo_description"
                                            value="{{ old('seo_description', $page->seo_description) }}"
                                            placeholder="Please provide seo description " required>
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
        $('.js-validation-insurance-feature-page').validate({
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
