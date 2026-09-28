@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Career Enquiries View</h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.career-enquiries.index') }}">Career Enquiries</a>
            <span class="breadcrumb-item active">View</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Career Enquiries</h3>
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
                {{-- <form class="js-validation-vehicles" action="{{ route('admin.services.update',$Service->id) }}" --}}
                {{-- method="post" enctype="multipart/form-data"> --}}
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-12 @error('title') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="title" name="title"
                                 value="{{ @old('title', $data->name) }}"
                                readonly>
                            <label for="title">Name</label>
                        </div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('title') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="title" name="title"
                             value="{{ @old('title', $data->email) }}"
                                readonly>
                            <label for="title">Email</label>
                        </div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('content') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control" id="content" name="content" rows="2"
                             readonly>{{ @old('content', $data->message) }}</textarea>
                            <label for="content">Message</label>
                        </div>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('content') is-invalid @enderror">
                        <div class="form-material">
                            <label for="content">Resume</label>
                            @if (@$data->cv)
                                <a href="{{ asset('storage/' . $data->cv) }}" target="_blank">View CV</a>
                            @else
                                No resume uploaded.
                            @endif
                        </div>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
