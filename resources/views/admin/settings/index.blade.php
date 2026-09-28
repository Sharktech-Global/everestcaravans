@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Settings</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Settings</span>
    </nav>
    <form class="js-validation-settings" action="{{ route('admin.settings.store') }}" method="post">
        @csrf
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Site Settings</h3>
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
                    <div class="col-md-6 @error('APP_NAME') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="APP_NAME" name="APP_NAME"
                                placeholder="Please provide name of the website"
                                value="{{ @old('APP_NAME',@$setting->where('key','APP_NAME')->first()->value) }}"
                                required>
                            <label for="APP_NAME">Website Name</label>
                        </div>
                        @error('APP_NAME')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('APP_URL') is-invalid @enderror">
                        <div class="form-material">
                            <input type="url" class="form-control" id="APP_URL" name="APP_URL"
                                placeholder="Please provide url of the website"
                                value="{{ @old('APP_URL',@$setting->where('key','APP_URL')->first()->value) }}"
                                required>
                            <label for="APP_URL">Website URL</label>
                        </div>
                        @error('APP_URL')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 @error('APP_ENV') is-invalid @enderror">
                        <div class="form-material">
                            <select class="form-control" id="APP_ENV" name="APP_ENV" required>
                                <option></option>
                                @foreach ($data['environment'] as $key => $value)
                                <option value="{{ $key }}" @if(@old('APP_ENV',@$setting->
                                    where('key','APP_ENV')->first()->value)==$key ) selected @endif>
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                            <label for="APP_ENV">Website Environment</label>
                        </div>
                        @error('APP_ENV')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('APP_DEBUG') is-invalid @enderror">
                        <div class="form-material">
                            <select class="form-control" id="APP_DEBUG" name="APP_DEBUG" required>
                                <option></option>
                                <option value="true" @if(@old('APP_DEBUG',$setting->
                                    where('key','APP_DEBUG')->first()->value)=="true" ) selected @endif>True</option>
                                <option value="false" @if(@old('APP_DEBUG',$setting->
                                    where('key','APP_DEBUG')->first()->value)=="false" ) selected @endif>False</option>
                            </select>
                            <label for="APP_DEBUG">Website Debug</label>
                        </div>
                        @error('APP_DEBUG')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('APP_TIME_ZONE') is-invalid @enderror">
                        <div class="form-material">
                            <select class="form-control" id="APP_TIME_ZONE" name="APP_TIME_ZONE" required>
                                <option></option>
                                @foreach ($data['timezone'] as $key => $value)
                                <option value="{{ $value }}" @if(@old('APP_TIME_ZONE',$setting->
                                    where('key','APP_TIME_ZONE')->first()->value)==$value ) selected @endif>
                                    {{ $key }}
                                </option>
                                @endforeach
                            </select>
                            <label for="APP_TIME_ZONE">Website Time Zone</label>
                        </div>
                        @error('APP_TIME_ZONE')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">SMTP Settings</h3>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <div class="col-md-6 @error('MAIL_HOST') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="MAIL_HOST" name="MAIL_HOST"
                                placeholder="Please provide mail host"
                                value="{{ @old('MAIL_HOST',$setting->where('key','MAIL_HOST')->first()->value) }}"
                                required>
                            <label for="MAIL_HOST">Mail Host</label>
                        </div>
                        @error('MAIL_HOST')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 @error('MAIL_PORT') is-invalid @enderror">
                        <div class="form-material">
                            <input type="number" min="0" class="form-control" id="MAIL_PORT" name="MAIL_PORT"
                                placeholder="Please provide mail port"
                                value="{{ @old('MAIL_PORT',$setting->where('key','MAIL_PORT')->first()->value) }}"
                                required>
                            <label for="MAIL_PORT">Mail Port</label>
                        </div>
                        @error('MAIL_PORT')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('MAIL_USERNAME') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="MAIL_USERNAME" name="MAIL_USERNAME"
                                placeholder="Please provide mail username"
                                value="{{ @old('MAIL_USERNAME',$setting->where('key','MAIL_USERNAME')->first()->value) }}"
                                required>
                            <label for="MAIL_USERNAME">Mail Username</label>
                        </div>
                        @error('MAIL_USERNAME')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 @error('MAIL_PASSWORD') is-invalid @enderror">
                        <div class="form-material">
                            <input type="password" class="form-control" id="MAIL_PASSWORD" name="MAIL_PASSWORD"
                                placeholder="Please provide mail password"
                                value="{{ @old('MAIL_PASSWORD',$setting->where('key','MAIL_PASSWORD')->first()->value) }}"
                                required>
                            <label for="MAIL_PASSWORD">Mail Password</label>
                        </div>
                        @error('MAIL_PASSWORD')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-md-6 @error('MAIL_FROM_ADDRESS') is-invalid @enderror">
                        <div class="form-material">
                            <input type="email" class="form-control" id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS"
                                placeholder="Please provide mail from address"
                                value="{{ @old('MAIL_FROM_ADDRESS',$setting->where('key','MAIL_FROM_ADDRESS')->first()->value) }}"
                                required>
                            <label for="MAIL_FROM_ADDRESS">Mail From Address</label>
                        </div>
                        @error('MAIL_FROM_ADDRESS')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 @error('MAIL_FROM_NAME') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="MAIL_FROM_NAME" name="MAIL_FROM_NAME"
                                placeholder="Please provide mail from name"
                                value="{{ @old('MAIL_FROM_NAME',$setting->where('key','MAIL_FROM_NAME')->first()->value) }}"
                                required>
                            <label for="MAIL_FROM_NAME">Mail From Name</label>
                        </div>
                        @error('MAIL_FROM_NAME')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Google Captcha Settings</h3>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <div class="col-md-6 @error('NOCAPTCHA_SECRET') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="NOCAPTCHA_SECRET" name="NOCAPTCHA_SECRET"
                                placeholder="Please provide captcha secret key"
                                value="{{ @old('NOCAPTCHA_SECRET',$setting->where('key','NOCAPTCHA_SECRET')->first()->value) }}"
                                required>
                            <label for="NOCAPTCHA_SECRET">Secret Key</label>
                        </div>
                        @error('NOCAPTCHA_SECRET')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('NOCAPTCHA_SITEKEY') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="NOCAPTCHA_SITEKEY" name="NOCAPTCHA_SITEKEY"
                                placeholder="Please provide captcha site key"
                                value="{{ @old('NOCAPTCHA_SITEKEY',$setting->where('key','NOCAPTCHA_SITEKEY')->first()->value) }}"
                                required>
                            <label for="NOCAPTCHA_SITEKEY">Site Key</label>
                        </div>
                        @error('NOCAPTCHA_SITEKEY')
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
@section('css_after')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('js_after')
<script>
    $('#APP_ENV').select2({
        placeholder: 'Please select environment of the website',
        width: '100%',
        allowClear:true
    });
    $('#APP_DEBUG').select2({
        placeholder: 'Please select debug status of the website',
        width: '100%',
        allowClear:true
    });
    $('#APP_TIME_ZONE').select2({
        placeholder: 'Please select timezone of the website',
        width: '100%',
        allowClear:true
    });
    $('.js-validation-settings').validate({
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