@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Edit Section Content</h2>
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
                <form class="js-validation-sections" action="{{ route('admin.sections.content.update', ['id' => @$section->id, 'uuid' => @$content->id]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST') 
                    <div class="form-group row">
                        <div class="col-md-12 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control" id="title" name="title" rows="2"
                                    placeholder="Please provide title for the section">{{ @old('title', $content->title) }}</textarea>
                                <label for="title">Title</label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('icon_content') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control " id="icon_content" name="icon_content" rows="2"
                                    placeholder="Please provide description for the section">{{ @old('icon_content', $content->icon_content) }}</textarea>
                                <label for="icon_content">Icon Content</label>
                            </div>
                            @error('icon_content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('icon') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="icon" name="icon">
                                <label for="icon">Icon</label>
                            </div>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $content->icon) }}"  alt="Everest" width="250px">
                        </div>
                    </div>
                   
                    
                    <div class="form-group row">
                        <div class="col-md-4 @error('link') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="button_title" name="button_title"
                                    placeholder="Please provide a vehicle slug"
                                    value="{{ @old('button_title',@$content->button_title) }}">
                                <label for="button_title">Button Title</label>
                            </div>
                            @error('button_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('link') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="button_link" name="button_link"
                                    placeholder="Please provide a button link"
                                    value="{{ @old('button_link',@$content->button_link) }}">
                                <label for="button_link">Button Link</label>
                            </div>
                            @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('order') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="order" name="order"
                                    placeholder="Please provide booking amount for the section"
                                    value="{{ @old('order', $content->order) }}" required>
                                <label for="order">Order</label>
                            </div>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                        @if (@old('status', $content->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (!@old('status', $content->status)) checked @endif>
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
