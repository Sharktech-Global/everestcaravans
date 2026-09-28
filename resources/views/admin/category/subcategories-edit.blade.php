@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Sub Categories of {{@$category->name}} </h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.category_type.index') }}">{{@$categorytype->name}}</a>
        <a class="breadcrumb-item" href="{{ route('admin.category.index',[@$categorytype->id,@$category->id]) }}">{{@$category->name}}</a>
        <span class="breadcrumb-item active">Edit
            <a href='{{ route('admin.subcategory.index',[@$categorytype->id,@$category->id]) }}' > {{ $subcat->name ? $subcat->name : 'Sub Categories' }} </a> of {{@$category->name}} </span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Sub Category</h3>
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
            <form class="js-validation-subcat"
                action="{{ route('admin.subcategory.update',[@$categorytype->id,$category->id,$subcat->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 @error('name') is-invalid @enderror">
                        <div class="form-material">
                            <input class="form-control" type="text" id="name" name="name"  placeholder="Please provide name for category type"
                            required value="{{ @old('name',$subcat->name) }}">
                        <label for="name">Name</label>
                        </div>
                        @error('name')
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
                                    @if (@old('status',$subcat->status)) checked @endif>
                                <label class="custom-control-label" for="status1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                    @if (!@old('status',$subcat->status)) checked @endif>
                                <label class="custom-control-label" for="status2">Inactive</label>
                            </div>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 @error('is_similar') is-invalid @enderror p-0">
                        <label class="col-12">Similar</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="is_similar" id="is_similar1" value="1"
                                    @if (@old('is_similar',$subcat->is_similar == '1')) checked @endif>
                                <label class="custom-control-label" for="is_similar1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="is_similar" id="is_similar2" value="0"
                                    @if (!@old('is_similar',$subcat->is_similar)) checked @endif>
                                <label class="custom-control-label" for="is_similar2">No</label>
                            </div>
                            @error('is_similar')
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
    $('.js-validation-subcat').validate({
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
