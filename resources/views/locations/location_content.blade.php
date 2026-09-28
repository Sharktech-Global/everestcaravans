@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ $location_content->banner_image ? asset('storage/' . $location_content->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">{{ $location_content->title }}</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>{{ $location_content->title }}</span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="py-5" style="background-color: #000000;">
            <div class="container">
                <div class="row">
                    <div class="p-3 text-center col-md-12">
                        <div class="card">
                            <div class="p-5 card-body">
                                <h5 class="card-title font-weight-bold text-uppercase text-primary">{{ $page->title }}
                                </h5>
                                @if (@$location_content->image)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- <p class="text-justify">{!! $page->content !!}</p> -->
                                            <p class="text-justify">{!! str_ireplace('[location]', $page->slug, $page->content) !!}</p>
                                        </div>
                                        <div class="col-md-12">

                                            <img src="{{ asset('/storage/' . $location_content->image) }}"
                                                alt="Location Content Image">
                                            <!-- img  src="https://source.unsplash.com/1600x900/?nature,kerala" width="100%" height="100%" /> -->

                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <p class="text-justify">{!! $page->content !!}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pb-0 bg-black">

            <!-- CARRER VACCANCIES -->
            <div class="container pt-5">
                <div class="row">
                    <div class="col-lg-6">
                        <p class="mb-4 text-white">Wish to try out your choice of car before the final purchase? Why not
                            take it take it out for a test drive and be sure it’s the one for you.</p>
                        <p class="mb-4 text-white">Please fill in the form below to request for a test drive and one of our
                            sales representatives will get back to you at the earliest with confirmation of the booking.</p>
                        <img alt="Request a test drive" title="Request a test drive"
                            src="{{ asset('assets/images/background/car.png') }}" class="pt-4 mt-5">
                    </div>
                    <div class="bg-white offset-lg-1 col-lg-5">
                        <div class="bg-white hero__form carBooking">
                            <h3><span class="text-primary">REQUEST A TEST DRIVE</span></h3>
                            <form action="{{ route('test-drive.store') }}" class="call__form js-validation-test-drive"
                                method="post">
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
                                        <input type="text" class="bg-F4F4F4 @error('name') is-invalid @enderror"
                                            placeholder="Name *" name="name" value="{{ @old('name') }}" required
                                            pattern="^[a-zA-Z\s]+$" minlength="3">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <input type="email" class="bg-F4F4F4 @error('email') is-invalid @enderror"
                                            placeholder="Email Address *" name="email" value="{{ @old('email') }}"
                                            required pattern="^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <input type="text"
                                            class="bg-F4F4F4 phone_number_mask @error('phone') is-invalid @enderror"
                                            placeholder="Phone Number *" name="phone" value="{{ @old('phone') }}"
                                            required pattern="\+(?:[0-9] ?){6,14}[0-9]$">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <select
                                            class="form-control br-50 h-48 bg-F4F4F4 @error('model') is-invalid @enderror"
                                            name="model" required>
                                            <option value="">Model *</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}"
                                                    {{ @old('model') == $vehicle->id ? 'selected' : '' }}>
                                                    {{ $vehicle->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('model')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <select
                                            class="form-control br-50 h-48 bg-F4F4F4 @error('location') is-invalid @enderror"
                                            name="location" required>
                                            <option value="">Location *</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}"
                                                    {{ $page->title == $location->name ? 'selected' : '' }}>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <textarea class="form-control bg-F4F4F4 @error('address') is-invalid @enderror"
                                            placeholder="Address" rows="4"
                                            name="address">{{ @old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pb-1 col-lg-12 form-group">
                                        <select
                                            class="form-control br-50 h-48 bg-F4F4F4 @error('time_of_contact') is-invalid @enderror"
                                            name="time_of_contact" required>
                                            <option value="">Preferred Time of contact *</option>
                                            <option value="Morning"
                                                {{ @old('location') == 'Morning' ? 'selected' : '' }}>
                                                Morning</option>
                                            <option value="Afternoon"
                                                {{ @old('location') == 'Afternoon' ? 'selected' : '' }}>
                                                Afternoon</option>
                                            <option value="Evening"
                                                {{ @old('location') == 'Evening' ? 'selected' : '' }}>
                                                Evening</option>
                                        </select>
                                        @error('time_of_contact')
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

        </section>
    </main>
@endsection
@section('js_after')
    <script>
        $(document).ready(function() {
            $('.phone_number_mask').inputmask("+\\919999999999");
            $('.js-validation-test-drive').validate({
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
