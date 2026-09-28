@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">E-Outlets</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.dealership.e_outlet.index',$dealership->id) }}">E-Outlets</a>
        <span class="breadcrumb-item active">Edit</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit E-Outlets</h3>
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
            <form class="js-validation-dealership.e_outlet"
                action="{{ route('admin.dealership.e_outlet.update',[$dealership->id,$e_outlet->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-4 @error('spc_name') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="spc_name" name="spc_name"
                                placeholder="Please provide spc name" value="{{ @old('spc_name',$e_outlet->spc_name) }}"
                                required>
                            <label for="spc_name">SPC Name</label>
                        </div>
                        @error('spc_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('spc_head') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="spc_head" name="spc_head"
                                placeholder="Please provide spc head" value="{{ @old('spc_head',$e_outlet->spc_head) }}"
                                required>
                            <label for="spc_head">SPC Head</label>
                        </div>
                        @error('spc_head')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('spc_phone') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="spc_phone" name="spc_phone"
                                placeholder="Please provide spc phone" value="{{ @old('spc_phone',$e_outlet->spc_head_phone) }}"
                                required>
                            <label for="spc_phone">SPC Phone</label>
                        </div>
                        @error('spc_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('spc_email') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="spc_email" name="spc_email"
                                placeholder="Please provide spc email" value="{{ @old('spc_email',$e_outlet->spc_head_email) }}"
                                required>
                            <label for="spc_email">SPC Email</label>
                        </div>
                        @error('spc_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 @error('spc_address') is-invalid @enderror">
                        <div class="form-material">
                            <textarea name="spc_address" class="form-control" required>{{old('spc_address',$e_outlet->address)}}</textarea>
                            <label for="spc_address">SPC Address</label>
                        </div>
                        @error('spc_address')
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
                                    @if ($e_outlet->status == 1) checked @endif>
                                <label class="custom-control-label" for="status1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                    @if ($e_outlet->status == 0) checked @endif>
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
    $(document).ready(function() {
        $('.js-validation-dealership.e_outlet').validate({
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
    });
</script>
@endsection
