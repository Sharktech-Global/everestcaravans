@extends('layouts.front')
@section('css_after')
    {{-- <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}"> --}}
    <style>
        .hero__form.carBooking {
            max-width: 100%;
        }

        input.form-control, .form-control {
    height: 60px;
}
.form-control:focus {
    border-color: #1e285f;
    box-shadow: unset;
}
.bookingDetails {
    background: #1e285f;
    display: inline-block;
    border-radius: 10px;
    margin-bottom: 15px;
}
.paymentHead {
    background: #1e285f;
    display: inline-block;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 15px;
}
        ::placeholder,
        textarea::placeholder,
        textarea {
            color: #ccc;
        }
        .extra-comments {
            display: inline-block;
        }
        .make-payment button {
    background-color: var(--color-1);
    color: var(--white);
    font-style: italic;
    font-size: 20px;
    height: 60px;
    padding: 0 30px;
    border-radius: 10px;
    transition: 0.5s;
}
        .make-payment button:hover {
    background-color: var(--color-2);
    color: var(--white);
}
    </style>
@endsection
@section('content')

    <section class="section"
        style="background-color: #fff; padding-top: 200px; padding-bottom: 100px;">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="mt-1 col-lg-10">
                    {{-- <a href="{{ url()->previous() }}" class=" btn btn-primary pull-right">Edit Booking</a> --}}
                    <div class="hero__form carBooking">

                        <h2 class="title text-center mb-70">CHECKOUT</h2>

                        <form name="customerData" action="{{ route('checkout.store', $vehicle->slug) }}"
                            class="call__form js-validation-checkout checkoutForm" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-20">
                                        <p class=""><b>Personal Information</b></p>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label " for="model">First Name *</label>
                                            <input type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                name="first_name" value="{{ @old('first_name', @$booking['name']) }}"
                                                required pattern="^[a-zA-Z\s]+$" minlength="3">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label " for="model">Last Name *</label>
                                            <input type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                name="last_name" value="{{ @old('last_name') }}" required
                                                pattern="^[a-zA-Z\s]+$">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label " for="model">Email *</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ @old('email',  @$booking['email']) }}" required
                                                pattern="^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <a href="#" class="text-dark" data-toggle="tooltip" title="Add Country code +91"> <label class="form-label " for="model">Phone Number </label>*</a>
                                            <input type="text"
                                                class="form-control phone @error('phone') is-invalid @enderror"
                                                name="phone" value="{{ @old('phone') }}" required
                                                pattern="\+(?:[0-9] ?){6,14}[0-9]$">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label " for="model">Country *</label>
                                            <select class="form-control @error('country') is-invalid @enderror"
                                                name="country" required>
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        {{ @old('country') == $country->id ? 'selected' : '' }}>
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label " for="model">Region/State *</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror"
                                                name="state" value="{{ @old('state') }}" required
                                                pattern="^[a-zA-Z\s]+$" minlength="3">
                                            @error('state')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label " for="model">City *</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                                name="city" value="{{ @old('city') }}" required
                                                pattern="^[a-zA-Z\s]+$" minlength="3">
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label " for="model">Post Code *</label>
                                            <input type="text"
                                                class="form-control @error('postcode') is-invalid @enderror" inputmode="numeric"  pattern="[0-9]{6}" name="postcode"
                                                value="{{ @old('postcode') }}" required
                                                oninvalid="this.setCustomValidity('Incorrect Post Code')"
                                                oninput="this.setCustomValidity('')"
                                                >
                                            @error('postcode')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label " for="model">Proof *</label>
                                            <input type="file" class="form-control border-0 px-0" name="proof" required>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-label " for="model">Billing Address *</label>
                                            <textarea style="height: 100px;" class="form-control @error('billing_address') is-invalid @enderror" rows="4" name="billing_address"
                                                required>{{ @old('billing_address') }}</textarea>
                                            @error('billing_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="location" value="{{ $location }}">
                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="col-md-12">
                                        <p class="text-white"><b>Booking Details</b></p>
                                    </div>
                                    <div class="pb-1 col-lg-12 bookingDetails">
                                        <label class="float-left  p-3 pt-5 pb-5 bg-F4F4F4 w-100 br-50">
                                            <b class="text-white text-uppercase">{{ $vehicle->name }}</b> <br>
                                            <small class="text-light">
                                                @foreach ($booking as $key => $value)
                                                    - {{ strtoupper($key) }}:  @if ($key == 'proof')
                                                    <img src="{{ asset('storage/' . $value) }}" onclick='enlargeImg()'
                                                        width="100px" id="img1" />
                                                @else
                                                    {{ $value }}
                                                @endif <br>
                                                @endforeach
                                            </small> <br>
                                            <b class="text-white text-uppercase">Amount: &#8377;{{ number_format($vehicle->booking_amount) }}</b>
                                        </label>
                                    </div>
                                    <div class="float-left col-lg-12 paymentHead">
                                        <b class="text-white text-uppercase">Payment Method</b>

                                        <div class="form-group mb-0">
                                            <label class="form-label text-light">
                                                <small>
                                                <input style="width: auto" class="d-inline-flex mr-2" type="radio" name="payment" value="ccavenue" @if (@old('payment', @$old->payment) == 'ccavenue') checked @else checked @endif required>Pay Online 
                                                </small>
                                            </label>
                                            {{-- <label class="form-label text-light">
                                                <small>
                                                <input style="width: auto" class="d-inline-flex mr-2" type="radio"
                                                    name="payment" value="cod" checked
                                                     required>Offline Payment
                                                </small>
                                            </label> --}}
                                        </div>
                                    </div>

                                    <div class="form-group extra-comments w-100">
                                        <label class="form-label " for="model">Add comments to your booking</label>
                                        <textarea style="height: 100px;" class="form-control @error('comment') is-invalid @enderror" rows="4" name="comment">{{ @old('comment') }}</textarea>
                                        @error('comment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="float-left form-group">
                                        <label class="form-check-label checkoutcheck">
                                            <input style="width: auto" class="d-inline-flex mr-2" type="checkbox"
                                                name="terms" value="1"
                                                @if (@old('terms') == '1') checked @endif required>I agree
                                            to <b><a class="text-white" href="{{ route('terms.show') }}"
                                                    target="_blank"><span style="color:#ff0000">Terms &
                                                    Conditions</span></a></b> and <b><a class="text-white"
                                                    href="{{ route('privacy.show') }}" target="_blank"><span style="color:#ff0000">Privacy
                                                    policy</span></a></b>
                                        </label>
                                    </div>
                                    <div class="float-left form-group make-payment w-100">
                                        <div class="mt-2 text-right">
                                            <!-- <button type="submit" class="btn site-btn w-100">MAKE PAYMENT</button> -->
                                            <button type="submit" name="submit" class="form-control submit-btn new-btn-style new-btn-style03">
                                                <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                                    viewBox="0 0 21 14" fill="none">
                                                    <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <img src="{{ asset('assets/abreco/images/shapes/right.svg') }}" class="d-none white" alt="">
                                                Make Payment
                                            </button>
                                        </div>
                                    </div>
                                    <marquee behavior="scroll" direction="left"><h4 style="color:#ff0000">No live payment transactions could be performed currently.</h4></marquee>

									<input type="hidden" name="tid" id="tid" readonly />
									<input type="hidden" name="merchant_id" value="2908487"/>
									<input type="hidden" name="order_id" value="{{ 'ORD' . rand(1000, 9999) }}"/>
									<input type="hidden" name="amount" value="{{ $vehicle->booking_amount}}"/>
									<input type="hidden" name="currency" value="INR"/>
									<input type="hidden" name="redirect_url" value="{{route('ccavenue.payment.response')}}"/>
									<input type="hidden" name="cancel_url" value="{{route('ccavenue.payment.response')}}"/>
									<input type="hidden" name="language" value="EN"/>
									<input type="hidden" name="billing_name" value="Charli"/>
									<input type="hidden" name="billing_city" value="Indore"/>
									<input type="hidden" name="billing_state" value="MP"/>
									<input type="hidden" name="billing_zip" value="425001"/>
									<input type="hidden" name="billing_country" value="India"/>
									<input type="hidden" name="billing_tel" value="9876543210"/>
									<input type="hidden" name="billing_email" value="test@test.com"/>
									<input type="hidden" name="delivery_name" value="Chaplin"/>
									<input type="hidden" name="delivery_address" value="test address"/>
									<input type="hidden" name="delivery_city" value="Hyderabad"/>
									<input type="hidden" name="delivery_state" value="Andhra"/>
									<input type="hidden" name="delivery_zip" value="425001"/>
									<input type="hidden" name="delivery_country" value="India"/>
									<input type="hidden" name="delivery_tel" value="9876543210"/>
									<input type="hidden" name="merchant_param1" value="additional Info."/>
									<input type="hidden" name="merchant_param2" value="additional Info."/>
									<input type="hidden" name="merchant_param3" value="additional Info."/>
									<input type="hidden" name="merchant_param4" value="additional Info."/>
									<input type="hidden" name="merchant_param5" value="additional Info."/>
									
				
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_after')
<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>
<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
     <script>
        img = document.getElementById("img1");
        // Function to set image dimensions
        function enlargeImg() {
            alert('yes')
            $('#img1').removeAttr('onclick');
            img.style.width = "60%";
            img.style.height = "auto";
            img.style.transition = "width 0.5s ease";
            $('#img1').attr('onclick', 'resetImg()');
        }
        // Function to reset image dimensions
        function resetImg() {
            img.style.width = "100px";
            img.style.height = "auto";
            img.style.transition = "width 0.5s ease";
            $('#img1').attr('onclick', 'enlargeImg()');
        }
    </script>
@endsection
