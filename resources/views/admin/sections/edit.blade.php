@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Sections</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.sections.index') }}">Sections</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Section</h3>
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
                <form class="js-validation-sections" action="{{ route('admin.sections.update', $section->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-6 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control" id="title" name="title" rows="2"
                                    placeholder="Please provide title for the section">{{ @old('title', $section->title) }}</textarea>
                                <label for="title">Title</label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('sub_title') is-invalid @enderror">
                            <div class="form-material">
                                <textarea required class="form-control" id="sub_title" name="sub_title" rows="2"
                                    placeholder="Please provide sub_title for the vehicle">{{ @old('sub_title', $section->sub_title) }}</textarea>
                                <label for="sub_title">Sub Title <span class="text-danger">*</span></label>
                            </div>
                            @error('sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('description') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="description" name="description" rows="2"
                                    placeholder="Please provide description for the section">{{ @old('description', $section->description) }}</textarea>
                                <label for="description">Content</label>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('sub_content') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="sub_content" name="sub_content" rows="2"
                                    placeholder="Please provide sub_content for the vehicle">{{ @old('sub_content', $section->sub_content) }}</textarea>
                                <label for="sub_content">Sub Content</label>
                            </div>
                            @error('sub_content')
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
                            <img src="{{ asset('storage/' . $section->image) }}"  alt="Everest" width="250px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('thumb') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="thumb" name="thumb">
                                <label for="thumb">Thumb Image</label>
                            </div>
                            @error('thumb')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $section->thumbnail) }}"  alt="Everest" width="250px">
                        </div>
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
                        @if($section->background)
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $section->background) }}"  alt="Everest" width="250px">
                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 @error('link') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="link" name="link"
                                    placeholder="Please provide a vehicle slug"
                                    value="{{ @old('link',@$section->link) }}">
                                <label for="link">Link</label>
                            </div>
                            @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('order_number') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="order_number" name="order_number"
                                    placeholder="Please provide booking amount for the section"
                                    value="{{ @old('order_number', $section->order) }}" required>
                                <label for="order_number">Order</label>
                            </div>
                            @error('order_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                        @if (@old('status', $section->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (!@old('status', $section->status)) checked @endif>
                                    <label class="custom-control-label" for="status2">No</label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
       
        $('.js-validation-sections').validate({
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
