@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Vehicle Types</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicle-types.index') }}">Vehicle Types</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Vehicle Type</h3>
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
                <form class="js-validation-vehicle-type" action="{{ route('admin.vehicle-types.update', $type->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-6 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Please provide vehicle type" value="{{ @old('name', $type->name) }}"
                                    required>
                                <label for="name">Name</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('order') is-invalid @enderror">
                            <div class="form-material">
                                <input type="number" min="1" class="form-control" id="order" name="order"
                                    placeholder="Please provide order of vehicle type"
                                    value="{{ @old('order', $type->order) }}" required>
                                <label for="order">Order</label>
                            </div>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('has_sales_page') is-invalid @enderror p-0">
                            <label class="col-12">Has Sales Page?</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="has_sales_page"
                                        id="has_sales_page1" value="1" @if (@old('has_sales_page', $type->has_sales_page)) checked @endif>
                                    <label class="custom-control-label" for="has_sales_page1">Yes</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="has_sales_page"
                                        id="has_sales_page2" value="0" @if (!@old('has_sales_page', $type->has_sales_page)) checked @endif>
                                    <label class="custom-control-label" for="has_sales_page2">No</label>
                                </div>
                                @error('has_sales_page')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                        @if (@old('status', $type->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Active</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (!@old('status', $type->status)) checked @endif>
                                    <label class="custom-control-label" for="status2">Inactive</label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('sales_page') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="sales_page" name="sales_page"
                                    placeholder="Please provide path of the sales page"
                                    value="{{ @old('sales_page', $type->sales_page) }}">
                                <label for="sales_page">Path of Sales Page</label>
                            </div>
                            @error('sales_page')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="image" name="image" multiple>
                                <label for="feature_image">Image <span class="text-danger">*</span></label>
                                @if($type->image)
                                    <img height="100px;" src="{{asset('storage/'.$type->image)}}">
                                @endif
                            </div>
                            @error('image')
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
                                    <input type="text" class="form-control" id="seo_title" name="seo_title"
                                        value="{{ @$type->seo_title }}" placeholder="Please provide seo title "
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
                                        value="{{ @$type->seo_keywords }}" placeholder="Please provide seo keywords "
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
                                        value="{{ @$type->seo_description }}"
                                        placeholder="Please provide seo description ">
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
        $('.js-validation-vehicle-type').validate({
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
