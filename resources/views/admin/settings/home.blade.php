@extends('admin.layouts.app')

@section('content')
{{-- @dd($home_settings); --}}
<div class="content">
    <h2 class="content-heading">Home Settings</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Settings</span>
    </nav>
    <form class="js-validation-settings" action="{{ route('admin.settings.home_store') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Home Settings</h3>
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
                <div class="form-group row">
                    <div class="col-md-6 @error('testdrive_text') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control testdrive_text" id="testdrive_text"
                                name="testdrive_text" placeholder="Please provide test drive text "
                                value="{{ @$home_settings->testdrive_text }}" required>
                            <label for="testdrive_text">Test Drive Text </label>
                        </div>
                        @error('testdrive_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('insurance_text') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="insurance_text" name="insurance_text"
                                value="{{ @$home_settings->insurance_text }}"
                                placeholder="Please provide insurance text " required>
                            <label for="insurance_text">Insurance Text</label>
                        </div>
                        @error('insurance_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('exchange_text') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="exchange_text" name="exchange_text"
                                value="{{ @$home_settings->exchange_text }}" placeholder="Please provide exchange text "
                                required>
                            <label for="exchange_text">Exchange Text</label>
                        </div>
                        @error('exchange_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('service_text') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="service_text" name="service_text"
                                placeholder="Please provide service text " value="{{ @$home_settings->service_text }}"
                                required>
                            <label for="service_text">Service Text</label>
                        </div>
                        @error('service_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Home Settings</h3>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <div class="col-md-6 @error('testdrive_image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="testdrive_image" name="testdrive_image">
                            <label for="testdrive_image">Test Drive Image</label>
                            @if(@$home_settings->testdrive_image)
                            <img alt="Everest" src="{{ asset('storage/'.@$home_settings->testdrive_image) }}"
                            style="width: 200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('testdrive_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('insurance_image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="insurance_image" name="insurance_image">
                            <label for="insurance_image">Insurance Image</label>
                            @if(@$home_settings->insurance_image)
                            <img alt="Everest" src="{{ asset('storage/'.@$home_settings->insurance_image) }}"
                            style="width: 200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('insurance_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('exchange_image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="exchange_image" name="exchange_image">
                            <label for="exchange_image">Exchange Image</label>
                            @if(@$home_settings->exchange_image)
                            <img alt="Everest" src="{{ asset('storage/'.@$home_settings->exchange_image) }}"
                            style="width: 200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('exchange_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('service_image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="service_image" name="service_image">
                            <label for="service_image">Service Image</label>
                            @if(@$home_settings->service_image)
                            <img alt="Everest" src="{{ asset('storage/'.@$home_settings->service_image) }}"
                            style="width: 200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('service_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Background Images</h3>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <div class="col-md-6 @error('background_image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="background_image" name="background_image">
                            <label for="background_image">Background Image</label>
                            @if(@$home_settings->background_image)
                            <img alt="Everest" src="{{ asset('storage/'.@$home_settings->background_image) }}"
                            style="width: 200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('background_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('contact_image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="contact_image" name="contact_image">
                            <label for="contact_image">Contact Background Image</label>
                            @if(@$home_settings->contact_image)
                            <img alt="Everest" src="{{ asset('storage/'.@$home_settings->contact_image) }}"
                            style="width: 200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('contact_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- seo -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Seo</h3>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <div class="col-md-6 @error('seo_title') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="seo_title" name="seo_title"
                                value="{{ @$home_settings->seo_title }}" placeholder="Please provide seo title "
                                required>
                            <label for="seo_title">Seo Title</label>
                        </div>
                        @error('seo_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 @error('seo_keywords') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="seo_keywords" name="seo_keywords"
                                value="{{ @$home_settings->seo_keywords }}" placeholder="Please provide seo keywords "
                                required>
                            <label for="seo_keywords">Seo Keywords</label>
                        </div>
                        @error('seo_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12 @error('seo_description') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="seo_description" name="seo_description"
                                value="{{ @$home_settings->seo_description }}"
                                placeholder="Please provide seo description " required>
                            <label for="seo_description">Seo Description</label>
                        </div>
                        @error('seo_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-content">
                <div class="form-group row">
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-alt-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('js_after')
<script>
    $(document).ready(function() {
        $('.js-validation-settings').validate({
            ignore: [],
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'label',
            errorPlacement: (error, e) => {
                $(e).parents('.form-group').append(error);
            },
            highlight: e => {
                $(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: e => {
                $(e).closest('.form-group').removeClass('is-invalid');
                $(e).remove();
            },
            messages: {
                phonenumber: {
                    pattern: "Please enter a valid phone number."
                },
                whatsapp: {
                    pattern: "Please enter a valid Whatsapp number."
                }
            }
        });
    });
</script>
@endsection
