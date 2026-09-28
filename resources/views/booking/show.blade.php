@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/booking.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
    <section id="contact_form_data" class="section insurance cardetailpage"
        style="background: url('{{ asset('assets/front/images/BGpattern.svg') }}') top left;background-color: #000;">
		<div class="container">
			<div class="row">
				{{-- <div class="col-sm-6" id="fifthSec">
                    <img id="vehicle-color-image" class="w-c" alt="{{ $vehicle->title }}" title="{{ $vehicle->title }}" src="{{ asset('storage/' . $vehicle->image) }}">
				</div> --}}
				<div class="col-md-10 offset-md-1 px-0">		
                        
                        
                         <div class="hero__form carBooking mt-0" id="online-booking">
                            <h3 class="title text-white mb-3">ONLINE BOOKING
                            {{-- <br>{{ strtoupper($vehicle->name) }} --}}
                            </h3>
                            <h4 class="text-white mb-3">BOOKING AMOUNT: <i class="fas fa-rupee-sign"></i> <span class="text-primary">{{ $vehicle->booking_amount }}</span></h4>
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>{{ session('error') }}
                            </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form id="booking-form" action="{{ route('booking.show', $vehicle->slug) }}"
                                class="call__form js-validation-booking" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label class="float-left w-100 text-white">Fuel *</label>
                                        @php
                                            $fuel_ids=[];
                                        @endphp
                                        @foreach ($vehicle->varients as $varient_fuel)
                                            @php 
                                                $fuel_ids[]=$varient_fuel->fuel_id;
                                            @endphp
                                        @endforeach
                                        @foreach ($fuels as $fuel)
                                            @if(in_array($fuel->id,$fuel_ids))
                                                <label class="float-left w-33 checkbox-inline text-white">
                                                    <input class="float-left" type="radio" checked name="fuel" value="{{ $fuel->name }}" required>{{ $fuel->name }}
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                    @if (count($varients))
                                        @foreach ($varients as $key => $value)
                                            @if ($value->count())
                                                <div id="varient-{{ $key }}"
                                                    class="form-group col-lg-12 varient-box">

                                                    <label class="float-left w-100 text-white">Variant *</label>
                                                    @foreach ($value as $varient)
                                                        <label class="float-left pr-3 w-33 checkbox-inline text-white">
                                                            <input type="radio" class="varient" name="varient"
                                                                value="{{ $varient->name }}" @if (@old('varient') == $varient->name) checked @endif >{{ $varient->name }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if ($vehicle->colors()->count())
                                        @php 
                                            $color_vehicle=$vehicle->colors()->first();
                                        @endphp
                                        <div class="form-group col-lg-12 all-colors">
                                            <label class="float-left w-100 text-white mb-2">Color *</label>
                                            @foreach ($vehicle->colors()->get() as $color)
                                                <div>
                                                    <input type="radio" @if($color_vehicle->id == $color->id) checked @endif name="color" id="{{ $color->name }}" value="{{ $color->name }}" @if (@old('color') == $color->name) checked @endif />
                                                    {{-- <label for="{{ $color->name }}">
                                                        <span class="{{ $color->name }}" style="background: {{ $color->color[1] }};"></span>
                                                    </label> --}}

                                                    <label for="{{ $color->name }}">
                                                        @if (count($color->color) == 1)
                                                            <span class="{{ $color->name }}" style="background: {{ $color->color[1] }};"></span>
                                                        @endif
                                                        @if (count($color->color) == 2)
                                                            <span class="{{ $color->name }}" style="background: linear-gradient(90deg, {{ $color->color[1] }} 0%, {{ $color->color[1] }} 52%, {{ $color->color[2] }} 52%, {{ $color->color[2] }} 100%);"></span>
                                                        @endif
                                                    </label>
                                                </div>

                                                {{-- <label class="float-left pr-3 w-50 checkbox-inline text-white">
                                                    <input type="radio" class="float-left color" name="color"
                                                        value="{{ $color->name }}" required @if (@old('color') == $color->name) checked @endif>
                                                    @if (count($color->color) == 1)
                                                        <span class="float-left mr-2 colorbox"
                                                            style="background: {{ $color->color[1] }};width: 20px; height: 20px;"></span>
                                                    @endif
                                                    @if (count($color->color) == 2)
                                                        <span class="float-left mr-2 colorbox"
                                                            style="border-top: 20px solid {{ $color->color[1] }};border-right: 20px solid {{ $color->color[2] }};"></span>
                                                    @endif
                                                    {{ $color->name }}
                                                </label> --}}
                                            @endforeach
                                            <img id="vehicle-color-image" class="w-100" alt="{{ $vehicle->title }}" title="{{ $vehicle->title }}" src="{{ asset('storage/' . $color_vehicle->image) }}">
                                            <span id="color-name-change"><span>{{$color_vehicle->name}}</span></span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label class="text-white">PAN Card Number *</label>
                                        <input type="text" value="{{@old('pan')}}" class="bg-F4F4F4 @error('pan') is-invalid @enderror" name="pan"
                                            required value="{{ @old('pan') }}"
                                            pattern="^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$">
                                        @error('pan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6">
                                        <label class="text-white">Booking Location *</label>
                                        <select id="location-select"
                                            class="form-control bg-F4F4F4 @error('location') is-invalid @enderror"
                                            name="location" required>
                                            <option value="">Select Location *</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}"
                                                    {{ @old('location') == $area->id ? 'selected' : '' }}>
                                                    {{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <label class="text-white">Address Proof *</label>
                                        <input type="file" class="form-control bg-F4F4F4 @error('proof') is-invalid @enderror"  value="{{@old('proof')}}" id="address-proof" name="proof" required>
                                        <small style="color:rgb(107, 107, 107)">
                                            Only jpeg,png and jpg formats accepted*
                                        </small>
                                        @error('proof')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-12">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display(['data-theme' => 'dark', 'required' => 'required']) !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                                <label style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-2 text-center"><button type="submit" class="site-btn">BOOK NOW</button></div>
                            </form>
                        </div>

				</div>
			</div>
		</div>
	</section>

@endsection
@section('js_after')

    <script>
        $(document).ready(function() {
            $('#booking-form input[name=fuel]').on('change', function() {
                var id = $('input[name=fuel]:checked', '#booking-form').val();
                $('.varient-box').addClass('d-none');
                $('input[name=varient]').removeAttr('checked');
                $('#varient-' + id).removeClass('d-none');
            });
            $('#booking-form input[name=color]').on('change', function() {
                var color = $('input[name=color]:checked', '#booking-form').val();
                var image_url = "{{ asset('storage') }}";
                $.ajax({
                    url: '{{ route('booking.show', $vehicle->slug) }}',
                    type: "get",
                    dataType: 'json',
                    data: {
                        color: color,
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#vehicle-color-image').attr('src', image_url + '/' + response
                                .color.image);
                            $('#color-name-change').html('<span>'+response.color.name+'</span>')
                        }
                    }
                });
            });
            $('.js-validation-booking').validate({
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
                }
            });
        });
    </script>
@endsection
