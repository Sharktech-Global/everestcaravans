@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$service_content->banner_image ? asset('storage/' . @$service_content->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="text-center row">
                <h1 class="text-center text-white col-md-12">SERVICE PRODUCT</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i>
                        <span>Service Product</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-0 bg-black">

           

            <!-- CARRER VACCANCIES -->
            <div class="container pt-5">
                <div class="row">
                    <div class="col-lg-6">
                        {{-- <p class="text-white">Please fill out the form to know about our service products.<br>Our
                        representative will
                        contact
                        you at the earliest with the requested information.</p> --}}
                        {{-- <img alt="" title="Maruthi Axlr8 Service Product enquiry"
                            src="{{ asset('storage/' . @$service_content->image) }}"
                            class="pt-4 mt-5 pos-abs pos-btm pos-mob"> --}}

                    </div>
                    <div class="bg-white offset-lg-1 col-lg-5" id='contact'>
                        <div class="bg-white hero__form carBooking">
                            <h3><span class="text-primary">SERVICE PRODUCT ENQUIRY</span></h3>
                            <form action="{{ route('service-products-enquiry.store') }}"
                                class="call__form js-validation-service-products-enquiry" method="post">
                                @csrf
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>{{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>{{ session('success') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="pb-1 col-lg-12 form-group">
                                        <select
                                            class="form-control bg-F4F4F4 br-50 h-48 @error('service_product') is-invalid @enderror"
                                            name="service_product" required>
                                            <option value="">Service Product *</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ @old('service_product', $req->id) == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('service_product')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <select
                                            class="form-control bg-F4F4F4 br-50 h-48 @error('details') is-invalid @enderror"
                                            name="details" required>
                                            <option value="">Details *</option>
                                            <option value="Existing Customer"
                                                {{ @old('details') == 'Existing Customer' ? 'selected' : '' }}>
                                                Existing Customer
                                            </option>
                                            <option value="New Customer"
                                                {{ @old('details') == 'New Customer' ? 'selected' : '' }}>
                                                New Customer
                                            </option>
                                        </select>
                                        @error('details')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <input type="text"
                                            class="form-control bg-F4F4F4 @error('name') is-invalid @enderror"
                                            placeholder="Name *" name="name" value="{{ @old('name') }}" required
                                            pattern="^[a-zA-Z\s]+$" minlength="3">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <input type="email"
                                            class="form-control bg-F4F4F4 @error('email') is-invalid @enderror"
                                            placeholder="Email Address *" name="email" value="{{ @old('email') }}"
                                            required pattern="^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <input type="text"
                                            class="form-control bg-F4F4F4 phone_number_mask @error('phone') is-invalid @enderror"
                                            placeholder="Phone Number *" name="phone" value="{{ @old('phone') }}"
                                            required pattern="\+(?:[0-9] ?){6,14}[0-9]$">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="pb-1 col-lg-12 form-group">
                                        <select
                                            class="form-control bg-F4F4F4 br-50 h-48 @error('location') is-invalid @enderror"
                                            name="location" required>
                                            <option value="">Location *</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}"
                                                    {{ @old('location') == $location->id ? 'selected' : '' }}>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-12">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                                <label
                                                    style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-2 text-center"><button type="submit" class="site-btn">SUBMIT</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CARRER VACCANCIES -->

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-white">
                            {!! @$service_content->content !!}
                        </p>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection
@section('js_after')
    <script>
        $(document).ready(function() {
            $('.phone_number_mask').inputmask("+\\919999999999");
            $('.js-validation-service-products-enquiry').validate({
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
                    name: {
                        pattern: "Name should not contain numbers or special characters."
                    },
                    email: {
                        pattern: "Please enter a valid email address."
                    },
                    phone: {
                        pattern: "Please enter a valid phone number."
                    },
                }
            });
        });
    </script>
@endsection
