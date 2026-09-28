@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Testimonial</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.testimonials.index') }}">Testimonial</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Testimonial</h3>
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
                <form class="js-validation-testimonials"
                    action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-6 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Please provide name" required
                                    value="{{ old('name', $testimonial->name) }}">
                                <label for="name">Name</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('designation') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="designation" name="designation"
                                    placeholder="Please provide designation"
                                    value="{{ @old('designation', $testimonial->designation) }}">
                                <label for="designation">Designation</label>
                            </div>
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="title" name="title"
                                    placeholder="Please provide title" value="{{ @old('title', $testimonial->title) }}">
                                <label for="title">Title</label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('rating') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="number" id="rating" name="rating"
                                    placeholder="Please provide rating" value="{{ @old('rating', $testimonial->rating) }}">
                                <label for="rating">Rating</label>
                            </div>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('message') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="message"
                                    name="message">{{ old('message', $testimonial->message) }}</textarea>
                                <label for="message">Message</label>
                            </div>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('content') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="content"
                                    name="content">{{ @old('content', $testimonial->content) }}</textarea>
                                <label for="content">Content</label>
                            </div>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('photo') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="photo" name="photo">
                                <label for="photo">Image</label>
                            </div>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $testimonial->photo) }}"  alt="Abreco" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('url') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="url" name="url"
                                    placeholder="Please provide video url" value="{{ @old('url', $testimonial->url) }}">
                                <label for="url">Video URL <small>Embed Video Link</small></label>
                            </div>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-alt-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js_after')
    <script>
        $('.js-validation-testimonials').validate({
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
