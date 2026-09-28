@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Locations</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.locations.index') }}">Locations</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Location</h3>
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
                <form class="js-validation-locations" action="{{ route('admin.locations.update', $location->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-4 @error('state') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="state" name="state" required>
                                    <option></option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ $location->state_id == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="name">State</label>
                            </div>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Please provide name of the location"
                                    value="{{ @old('name', $location->name) }}" required>
                                <label for="name">Name</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('location_type') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="location_type" name="location_type" required>
                                    <option></option>
                                    @foreach ($location_types as $location_type)
                                        <option value="{{ $location_type->id }}"
                                            {{ old('location_type', $location->location_type_id) == $location_type->id ? 'selected' : '' }}>
                                            {{ $location_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="location_type">Location Type</label>
                            </div>
                            @error('location_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 @error('email') is-invalid @enderror">
                            <div class="form-material">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Please provide email for the location"
                                    value="{{ @old('email', $location->email) }}">
                                <label for="email">Email Address</label>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('showroom') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="showroom" name="showroom">
                                    <option></option>
                                    <option value="Arena" @if (@old('showroom', $location->showroom) == 'Arena')
                                        selected
                                        @endif>{{ 'Arena' }}</option>
                                    <option value="Nexa" @if (@old('showroom', $location->showroom) == 'Nexa')
                                        selected
                                        @endif>{{ 'Nexa' }}</option>
                                    <option value="Commercial" @if (@old('showroom', $location->showroom) == 'Commercial')
                                            selected
                                            @endif>{{'Commercial' }}</option>
                                    <option value="Truevalue" @if (@old('showroom', $location->showroom) == 'Truevalue')
                                                selected
                                                @endif>{{ 'Truevalue' }}</option>
                                    <option value="MSGA" @if (@old('showroom', $location->showroom) == 'MSGA')
                                                    selected
                                                    @endif>{{ 'MSGA' }}</option>
                                </select>
                                <label for="showroom">Showroom Type</label>
                            </div>
                            @error('showroom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('erp_code') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="erp_code" name="erp_code"
                                    placeholder="Please provide erp code of the location"
                                    value="{{ @old('erp_code', $location->erp_code) }}">
                                <label for="erp_code">ERP Code</label>
                            </div>
                            @error('erp_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('content') is-invalid @enderror">
                            <div class="form-material">
                                <textarea name="content" class="form-control summernote" id="content"
                                    placeholder="Please provide content"
                                    required>{{ @old('content', $location->content) }}</textarea>
                                <label for="content">Content</label>
                            </div>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('address') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="address" name="address" rows="5"
                                    placeholder="Please provide address">{{ @old('address', $location->address) }}</textarea>
                                <label for="address">Address</label>
                            </div>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('banner_image') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="banner_image" name="banner_image">
                                <label for="banner_image">Icon</label>
                            </div>
                            dimension (265 × 187 px)

                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . @$location->banner_image) }}"  alt="Abreco" width="250px">
                            </div>

                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('icon2') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="icon2" name="icon2">
                                <label for="icon2">Icon2</label>
                            </div>
                            dimension (265 × 187 px)

                            <div class="col-md-6">
                                <img src="{{ asset('storage/' . @$location->icon2) }}"  alt="Abreco" width="250px">
                            </div>
                            @error('icon2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('map') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="map" name="map"
                                    value="{{ @old('map', $location->map) }}">
                                <label for="map">Map IFrame Link</label>
                            </div>
                            @error('map')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('email_ccs') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control" id="email_ccs" name="email_ccs" rows="2"
                                    placeholder="Please provide email ccs for the location">{{ @old('email_ccs', $location->email_ccs) }}</textarea>
                                <label for="email_ccs">Email Address for CC <small>Seperated By Comma</small></label>
                            </div>
                            @error('email_ccs')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('email_bccs') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control" id="email_bccs" name="email_bccs" rows="2"
                                    placeholder="Please provide email bccs for the location">{{ @old('email_bccs', $location->email_bccs) }}</textarea>
                                <label for="email_bccs">Email Address for BCC <small>Seperated By Comma</small></label>
                            </div>
                            @error('email_bccs')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('phone_numbers') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control" id="phone_numbers" name="phone_numbers" rows="2"
                                    placeholder="Please provide phone numbers for the location">{{ @old('phone_numbers', $location->phone_numbers) }}</textarea>
                                <label for="phone_numbers">Phone Numbers <small>Seperated By
                                        Comma</small></label>
                            </div>
                            @error('phone_numbers')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('order') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="number" min="1" class="form-control" id="order" name="order"
                                        placeholder="Please provide order"
                                        value="{{ @old('order',$location->order) }}" required>
                                    <label for="order">Order<span class="text-danger">*</span></label>
                                </div>
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-md-6 @error('status') is-invalid @enderror p-0">
                            <label class="col-12">Status</label>
                            <div class="col-12">
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                        @if (@old('status', $location->status)) checked @endif>
                                    <label class="custom-control-label" for="status1">Active</label>
                                </div>
                                <div class="mb-5 custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (!@old('status', $location->status)) checked @endif>
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
            $('#location_type').select2({
                placeholder: 'Please select a location type',
                width: '100%',
                allowClear: true
            });
            $('#state').select2({
                placeholder: 'Please select a state',
                width: '100%',
                allowClear: true
            });
        });
        $('.js-validation-locations').validate({
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
