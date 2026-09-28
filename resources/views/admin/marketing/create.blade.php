@extends('admin.layouts.app')

@section('css_after')
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-tagsinput.css')}}" />
@endsection
@section('content')
<div class="content">
    <h2 class="content-heading">Marketing</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.marketing.index') }}">Marketing</a>
        <span class="breadcrumb-item active">Create</span>
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
            <form class="js-validation-vehicles" action="{{ route('admin.marketing.store') }}" method="post" >
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 @error('tag') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="tag" name="tag" value="" placeholder="Please provide the tag " required>
                            <label for="tag">Tag</label>
                        </div>
                        @error('tag')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('values') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control col-md-6" id="inputTag" value="" name='values' data-role="tagsinput" placeholder="Please provide values seperated by space" >

                            {{-- <input type="text" id="inputTags" value="Amsterdam,Washington,Sydney,Beijing,Cairo" data-role="tagsinput"> --}}
                            <label for="values">Values</label>
                        </div>
                        @error('values')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="alert alert-warning" role="alert">
                    <h5><small> Please type </small> <b>[data]</b><small> for replacing the text with above value.</small></h5>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('content') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="content" name="content" rows="2" placeholder="Please provide content for the vehicle">{{ @old('content',@$location_content->content) }}</textarea>
                            <label for="content">Content</label>
                        </div>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                                        <input type="text" class="form-control" id="seo_title" name="seo_title" value="" placeholder="Please provide seo title with [data]" >
                                        <label for="seo_title">Seo Title</label>
                                    </div>
                                    @error('seo_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 @error('seo_keywords') is-invalid @enderror">
                                    <div class="form-material">
                                        <input type="text" class="form-control" id="seo_keywords" name="seo_keywords" value="" placeholder="Please provide seo keywords with [data]" >
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
                                        <input type="text" class="form-control" id="seo_description" name="seo_description" value="" placeholder="Please provide seo description with [data]" >
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
<script src="{{asset('assets/js/bootstrap-tagsinput.js')}}"></script>
<script>
    $("#inputTag").tagsinput({
        confirmKeys: [13, 32, 44]
    });


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
