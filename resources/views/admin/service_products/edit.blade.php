@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Service Products</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.service_products.index') }}">Service Products</a>
        <span class="breadcrumb-item active">Edit</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Service Product</h3>
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
            <form class="js-validation-service_products"
                action="{{ route('admin.service_products.update',$serviceProduct->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-6 @error('name') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Please provide service type"
                                value="{{ @old('name',$serviceProduct->name) }}" required>
                            <label for="name">Name</label>
                        </div>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('button_link') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="button_link" name="button_link"
                                placeholder="Please provide button link" value="{{ @old('button_link',$serviceProduct->button_link) }}"
                                required>
                            <label for="button_link">Button Link</label>
                        </div>
                        @error('button_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 @error('image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="image" name="image">
                            <label for="image">Image</label>
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $serviceProduct->image) }}"  alt="Abreco" width="250px">
                            </div>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('image_secondary') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="image_secondary" name="image_secondary">
                            <label for="image_secondary">Image</label>
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $serviceProduct->image_secondary) }}"  alt="Abreco" width="250px">
                            </div>
                        </div>
                        @error('image_secondary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('image_third') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="image_third" name="image_third">
                            <label for="image_third">Image</label>
                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . $serviceProduct->image_third) }}"  alt="Abreco" width="250px">
                            </div>
                        </div>
                        @error('image_third')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('description') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="description" name="description" rows="4"
                                placeholder="Please provide description for service product">{{ @old('description',$serviceProduct->description) }}</textarea>
                            <label for="description">Description</label>
                        </div>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('status') is-invalid @enderror p-0">
                        <label class="col-12">Status</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                    @if (@old('status',$serviceProduct->status)) checked @endif>
                                <label class="custom-control-label" for="status1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                    @if (!@old('status',$serviceProduct->status)) checked @endif>
                                <label class="custom-control-label" for="status2">Inactive</label>
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
    $('.js-validation-service_products').validate({
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