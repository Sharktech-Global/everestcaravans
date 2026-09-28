@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Finance</h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('finance.index') }}">Finance</a>
            <span class="breadcrumb-item active">Add</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Finance</h3>
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
                <form class="js-validation-vehicles" action="{{ route('finance.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-6 @error('service_id') is-invalid @enderror">
                            <div class="col-md-r @error('title') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Please provide title" value="{{ @old('title') }}" required>
                                    <label for="title">Title<span style="color:red;">*</span></label>
                                </div>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                {{--  <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Please provide title" value="{{ @old('title') }}" required>
                                <label for="name">Category<span style="color:red;">*</span></label>  --}}
                                <label for="category">Select Category:</label>
                                <select  class="form-control" name="category" id="category">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 @error('image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="image" name="image" required>
                                <label for="image">Image <span class="text-danger">*</span></label>
                            </div>
                            dimension (225 × 225 px)<br>
                            width-225 , height-225

                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="col-md-4 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" name="status" id="status1"
                                        value="1" @if (!@old('status')) checked @endif>
                                    <label class="custom-control-label" for="status1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" name="status" id="status2"
                                        value="0" @if (@old('status')) checked @endif>
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
        $('#service_id').select2({
            placeholder: 'Please select a service',
            width: '100%',
            allowClear: true
        });
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
