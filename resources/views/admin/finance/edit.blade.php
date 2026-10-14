@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Finance</h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('finance.index') }}">Finance</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Finance</h3>
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
                <form class="js-validation-vehicles" action="{{ route('finance.update', $Service->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-6 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Please provide title of the new page"
                                    value="{{ @old('title', $Service->title) }}" required>
                                <label for="title">Title</label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('category') is-invalid @enderror">
                            <div class="form-material">
                                {{--  <select class="form-control" id="category" name="category" required>
                                    <option></option>
                                    @foreach ($category as $data1)
                                        <option value="">Select Category</option>
                                        <option @if ($data1->title == $data1->category) selected @endif value={{ $data1->title }}>
                                            {{ $data1->title }}</option>
                                    @endforeach
                                </select>  --}}
                                <select id="category" name="category"
                                    class="form-control select2 @if ($errors->has('category')) is-invalid @endif"{{ @old('category') }}required>
                                    <option value="">Select Category</option>
                                    @foreach ($category as $data1)
                                        <option @if ($data1->id == $Service->category) selected @endif value={{ $data1->id }}>
                                            {{ $data1->title }}</option>
                                    @endforeach

                                </select>
                                <label for="service_id">category <span class="text-danger">*</span></label>
                                {{--  <label class="col-sm-3 col-form-label" for="service_care_id">Category
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select id="category" name="category"
                                        class="form-control select2 @if ($errors->has('category')) is-invalid @endif"{{ @old('category') }}required>
                                        <option value="">Select Category</option>
                                        @foreach ($category as $data1)
                                            <option @if ($data1->title == $data1->category) selected @endif
                                                value={{ $data1->title }}>{{ $data1->title }}</option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('service_care_id') }}</div>
                                </div>  --}}
                            </div>
                            @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="image" name="image">
                                <label for="image">Image</label>
                                dimension (225 × 225 px)<br>
                            width-225 , height-225
                                @if (@$Service->image)
                                    <img alt="Everest" src="{{ asset('storage/' . @$Service->image) }}"
                                        style="width: 100px;margin: 15px 0;">
                                @endif
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" name="status" id="status1"
                                        value="1" @if (@old('status', $Service->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" name="status" id="status2"
                                        value="0" @if (!@old('status', $Service->status)) checked @endif>
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
        $('.js-validation-vehicles').validate({
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
