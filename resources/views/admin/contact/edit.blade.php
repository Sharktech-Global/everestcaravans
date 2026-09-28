@extends('admin.layouts.app')
@section('css_after')

<link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}">
@endsection
@section('content')
{{-- @dd($contactss) --}}
<div class="content">
    <h2 class="content-heading">Contact</h2>
    {{-- <a class="btn btn-secondary float-right" href="{{ route('admin.address.index') }}" >Back</a> --}}
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.contact.index') }}">Contact</a>
        <span class="breadcrumb-item active">Edit</span>

    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Contact</h3>
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
            <form class="js-validation-contact" action="{{ route('admin.contact.update',$contacts->id) }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 @error('name') is-invalid @enderror">
                        <div class="form-material">
                            {{-- <div class="js-summernote">Hello Summernote!</div> --}}
                            <input type="text" class="form-control" placeholder="Please provide a contact name" name="name"required value="{{ @old('name',$contacts->name) }}">
                            <label for="name">Name</label>
                        </div>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('email') is-invalid @enderror">
                        <div class="form-material">
                            {{-- <div class="js-summernote">Hello Summernote!</div> --}}
                            <input type="email" class="form-control" placeholder="Please provide an email address" required name="email" value="{{ @old('email',$contacts->email) }}">
                            <label for="email">Email</label>
                        </div>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('phone') is-invalid @enderror">
                        <div class="form-material">
                            {{-- <div class="js-summernote">Hello Summernote!</div> --}}
                            <input type="text" class="form-control" placeholder="Please provide phone number" required pattern="\+(?:[0-9] ?){6,14}[0-9]$" name="phone" value="{{ @old('phone',$contacts->phone) }}">
                            <label for="phone">Phone Number</label>
                        </div>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('status') is-invalid @enderror p-0">
                        <label class="col-12">Status</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                    @if (@old('status',$contacts->status)) checked @endif>
                                <label class="custom-control-label" for="status1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                    @if (!@old('status',$contacts->status)) checked @endif>
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
<script src="{{ asset('js/summernote-bs4.js') }}"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script>
<script>
    $('.js-validation-address').validate({
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
