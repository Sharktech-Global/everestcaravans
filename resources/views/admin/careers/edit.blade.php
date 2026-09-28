@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Careers</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.careers.index') }}">Careers</a>
        <span class="breadcrumb-item active">Edit</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Career</h3>
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
            <form class="js-validation-careers" action="{{ route('admin.careers.update',$career->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-12 @error('title') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Please provide title of the job" value="{{ @old('title',$career->title) }}"
                                required>
                            <label for="title">Title</label>
                        </div>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('location') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="location" name="location"
                                placeholder="Please provide location of the job"
                                value="{{ @old('location',$career->location) }}">
                            <label for="location">Location</label>
                        </div>
                        @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('qualification') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="qualification" name="qualification"
                                placeholder="Please provide qualification for the job" value="{{ @old('qualification',$career->qualification) }}"
                                >
                            <label for="qualification">Qualification</label>
                        </div>
                        @error('qualification')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('experience') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="experience" name="experience"
                                placeholder="Please provide experience for the job"
                                value="{{ @old('experience',$career->experience) }}" >
                            <label for="experience">Experience</label>
                        </div>
                        @error('experience')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('email') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Please provide email for the job"
                                value="{{ @old('email',$career->email) }}" required>
                            <label for="email">Email Address</label>
                        </div>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('contact_numbers') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control" id="contact_numbers" name="contact_numbers" rows="2"
                                placeholder="Please provide contact numbers for the job">{{ @old('contact_numbers',$career->contact_numbers) }}</textarea>
                            <label for="contact_numbers">Phone Numbers <small>Seperated By
                                    Comma</small></label>
                        </div>
                        @error('contact_numbers')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('description') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="description" name="description" rows="2" placeholder="Please provide description for the job" >{{ @old('description',$career->description) }}</textarea>
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
                                    @if (@old('status',$career->status)) checked @endif>
                                <label class="custom-control-label" for="status1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                    @if (!@old('status',$career->status)) checked @endif>
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
    $('.js-validation-careers').validate({
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