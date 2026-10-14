@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">General Settings</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Settings</span>
    </nav>
    <form class="js-validation-settings" action="{{ route('admin.settings.general_store') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">General Settings</h3>
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
                    <div class="col-md-4 @error('phonenumber') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control phonenumber" id="phonenumber" name="phonenumber"
                                placeholder="Please provide mobile number" value="{{ @$settings->mobile }}"
                                 required>
                            <label for="phonenumber">Mobile Number</label>
                        </div>
                        @error('phonenumber')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('mobile_1') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control mobile_1" id="mobile_1" name="mobile_1"
                                placeholder="Please provide additional number" value="{{ @$settings->mobile_1 }}">
                            <label for="mobile_1">Additional Number</label>
                        </div>
                        @error('mobile_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('whatsapp') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                placeholder="Please provide whatsapp number" value="{{ @$settings->whatsapp }}"
                                pattern="\+(?:[0-9] ?){6,14}[0-9]$" required>
                            <label for="whatsapp">Whatsapp Number</label>
                        </div>
                        @error('whatsapp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('facebook') is-invalid @enderror">
                        <div class="form-material">
                            <input type="url" class="form-control" id="facebook" name="facebook"
                                placeholder="Please provide facebook url" value="{{ @$settings->facebook }}" required>
                            <label for="facebook">Facebook</label>
                        </div>
                        @error('facebook')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="col-md-6 @error('instagram') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control instagram" id="instagram" name="instagram"
                                placeholder="Please provide instagram" value="{{ @$settings->instagram }}"
                                 required>
                            <label for="phonenumber">Instagram</label>
                        </div>
                        @error('instagram')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="col-md-6 @error('youtube') is-invalid @enderror">
                        <div class="form-material">
                            <input type="url" class="form-control" id="youtube" name="youtube"
                                placeholder="Please provide youtube url" value="{{ @$settings->youtube }}" required>
                            <label for="youtube">Youtube</label>
                        </div>
                        @error('youtube')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('map') is-invalid @enderror">
                        <div class="form-material">
                            <input type="url" class="form-control" id="map" name="map"
                                placeholder="Please provide map url" value="{{ @$settings->map }}" required>
                            <label for="map">Map</label>
                        </div>
                        @error('map')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('linkedin') is-invalid @enderror">
                        <div class="form-material">
                            <input type="url" class="form-control" id="linkedin" name="linkedin"
                                placeholder="Please provide linkedin url" value="{{ @$settings->linkedin }}" >
                            <label for="linkedin">Linkedin</label>
                        </div>
                        @error('linkedin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('twitter') is-invalid @enderror">
                        <div class="form-material">
                            <input type="url" class="form-control" id="twitter" name="twitter"
                                placeholder="Please provide twitter url" value="{{ @$settings->twitter }}" >
                            <label for="twitter">Twitter</label>
                        </div>
                        @error('twitter')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('popup') is-invalid @enderror p-0">
                        <label class="col-12">Exit PopUp</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="popup" id="popup1" value="1"
                                    @if(@old('popup',$settings->popup)) checked @endif>
                                <label class="custom-control-label" for="popup1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="popup" id="popup2" value="0"
                                    @if(!@old('popup',$settings->popup)) checked @endif>
                                <label class="custom-control-label" for="popup2">Inactive</label>
                            </div>
                            @error('popup')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 @error('website_color') is-invalid @enderror">
                        <div class="form-material">
                            <input type="color" class="form-control" id="website_color" name="website_color"
                                placeholder="Select website color" value="{{ @$settings->website_color }}" required>
                            <label for="website_color">Website Color</label>
                        </div>
                        @error('website_color')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('address') is-invalid @enderror">
                        <div class="form-material">
                            <textarea  class="form-control" id="address" name="address"
                            placeholder="Please provide address ">{{ @$settings->address }}</textarea>
                           
                            <label for="address">address</label>
                        </div>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('email') is-invalid @enderror">
                        <div class="form-material">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Please provide email" value="{{ @$settings->email }}" >
                            <label for="email">email</label>
                        </div>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Logo Settings</h3>
            </div>
            <div class="block-content" style="background: #00000038;">
                <div class="form-group row">
                    <div class="col-md-3 @error('logo') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="logo" name="logo">
                            <label for="logo">White Logo First</label>
                            @if(@$settings->logo)
                            <img alt="Everest" src="{{ asset('storage/'.@$settings->logo) }}" style="width:
                            200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 @error('logo_secondary') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="logo_secondary" name="logo_secondary">
                            <label for="logo_secondary">White Logo Second</label>
                            @if(@$settings->logo_secondary)
                            <img alt="Everest" src="{{ asset('storage/'.@$settings->logo_secondary) }}" style="width:
                            200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('logo_secondary')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 @error('logo_fourth') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="logo_fourth" name="logo_fourth">
                            <label for="logo_fourth">Dark Logo First</label>
                            @if(@$settings->logo_fourth)
                            <img alt="Everest" src="{{ asset('storage/'.@$settings->logo_fourth) }}" style="width:
                            200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('logo_fourth')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 @error('logo_third') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="logo_third" name="logo_third">
                            <label for="logo_third">Dark Logo Second</label>
                            @if(@$settings->logo_third)
                            <img alt="Everest" src="{{ asset('storage/'.@$settings->logo_third) }}" style="width:
                            200px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('logo_third')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 @error('favicon') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="favicon" name="favicon">
                            <label for="favicon">Favicon</label>
                            @if(@$settings->favicon)
                            <img alt="Everest" src="{{ asset('storage/'.@$settings->favicon) }}" style="width:
                            32px;margin: 15px 0;">
                            @endif
                        </div>
                        @error('favicon')
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
