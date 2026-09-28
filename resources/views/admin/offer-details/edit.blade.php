@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Offer Details</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.offer_details.index') }}">Offer Details</a>
        <span class="breadcrumb-item active">Edit</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Offer</h3>
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
            <form class="js-validation-offer-details" action="{{ route('admin.offer_details.update',$offer->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="col-md-12 @error('state') is-invalid @enderror">
                        <div class="form-material">
                            <select class="form-control @error('state') is-invalid @enderror state" id="state" name="state" required>
                                @foreach ($states as $state)
                                <option value="{{ $state->id}}" @if($state->id == $offer->state_id)
                                    selected
                                @endif>{{$state->name}}</option>
                                @endforeach
                            </select>
                            <label for="state">State</label>
                        </div>
                        @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('model') is-invalid @enderror">
                        <div class="form-material">
                            <input class="form-control" type="text" id="model" name="model"  placeholder="Please provide model"
                                required value="{{ $offer->model}}">
                            <label for="model">Model</label>
                        </div>
                        @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('offer') is-invalid @enderror">
                        <div class="form-material">
                            <input class="form-control" type="text" id="offer" name="offer"  placeholder="Please provide offer"
                                required value="{{ $offer->offer}}">
                            <label for="offer">Offer</label>
                        </div>
                        @error('offer')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-alt-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    $('.js-validation-offer-details').validate({
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
