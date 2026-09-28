@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Area</h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.locations.index') }}">Area</a>
            <span class="breadcrumb-item active">Add</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Areas</h3>
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
                <form class="js-validation-dealership" action="{{ route('admin.area.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Please provide name of the location" value="{{ @old('name') }}" required>
                                <label for="name">Area</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('type') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="type" name="type" placeholder="Please provide Location Type"
                                    required>
                                    <option>Please select Location Type</option>
                                    @foreach ($type as $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('type') == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach

                                </select>
                                <label for="type">Location Type </label>
                            </div>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 @error('location') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="location" name="location" required>
                                    <input type="hidden" value="{{old('location')}}" id="locUnit">
                                    {{-- <option></option> --}}
                                    {{-- @foreach ($locations as $location)
                                        <option value="{{ $location->id }}"
                                            {{ old('location') == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach --}}
                                </select>
                                <label for="location">Location</label>
                            </div>
                            @error('location')
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
                                        @if (!@old('status')) checked @endif>
                                    <label class="custom-control-label" for="status1">Active</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                        @if (@old('status')) checked @endif>
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
            $('#location').select2({
                placeholder: 'Please select a location',
                width: '100%',
                allowClear: true
            });
            // $('#type').select2({
            //     placeholder: 'Please select a location type',
            //     width: '100%',
            //     allowClear: true
            // });
        });
        var unit = $('#locUnit').val();
        $('#type').change(function() {
            var dist = $('#type :selected').val();

            var $options = $('<option value="">--Select--</option>');
            $("#location").html($options);
            $.ajax({
                type: 'GET',
                url: "{{ route(Route::current()->getName()) }}",
                data: {
                    "type": dist
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.data) {
                        jQuery.each(response.data, function(index, item) {
                            if(item.id == unit) {
                                $options = $options.add($('<option selected>').attr('value', item.id).html(item.name));
                            } else {
                                $options = $options.add($('<option>').attr('value', item.id).html(item.name));
                            }
                        });
                    }
                    $("#location").html($options);
                }
            });

        });
        $('.js-validation-dealership').validate({
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
