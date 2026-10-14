@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Contact Page</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.contact-page.index') }}">Contact Page</a>
        <span class="breadcrumb-item active">Update</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Update Contact Page</h3>
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
            <form class="js-validation-contact-page" action="{{ route('admin.contact-page.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 @error('branch_helpline') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="branch_helpline"
                                name="branch_helpline">{{ @old('branch_helpline',$page->branch_helpline) }}</textarea>
                            <label for="branch_helpline">Branch Helpline</label>
                        </div>
                        @error('branch_helpline')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('contact_person') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="contact_person"
                                name="contact_person">{{ @old('contact_person',$page->contact_person) }}</textarea>
                            <label for="contact_person">Contact Person</label>
                        </div>
                        @error('contact_person')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('contact_info') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="contact_info" name="contact_info"
                                required>{{ @old('contact_info',$page->contact_info) }}</textarea>
                            <label for="contact_info">Contact Info</label>
                        </div>
                        @error('contact_info')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('map_url') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control" id="map_url" name="map_url" rows="2"
                                placeholder="Please provide url for google map"
                                required>{{ @old('map_url',$page->map_url) }}</textarea>
                            <label for="map_url">Map URL <small>Embed in an iframe</small></label>
                        </div>
                        @error('map_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="image" name="image">
                            <label for="image">Background Image</label>
                        </div>
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('storage/'.@$page->image) }}"  alt="Everest" width="250px">
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
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                        value="{{ @$page->seo_title }}" placeholder="Please provide seo title "
                                        required>
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
                                        required>
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
