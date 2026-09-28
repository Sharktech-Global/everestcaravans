@extends('layouts.front')
@section('css_after')
    {{-- <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}"> --}}
    <style>
        .hero__form.carBooking {
            max-width: 100%;
        }

        input.form-control,
        .form-control {
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
    <section class="section" style="background-color: #fff; padding-top: 200px; padding-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="mt-1 col-lg-8 offset-lg-2">
                    {{-- <a href="{{ url()->previous() }}" class=" btn btn-primary pull-right">Edit Booking</a> --}}
                    <div class="hero__form carBooking">
                        <div class="text-center">
                            <i class="fa fa-check"
                                style="color: #009d06;font-size: 50px;border-radius: 50px;background: #141414;padding: 15px;"></i>
                            <h1 class="text-center text-dark col-md-12 mt-4">Booking Successful</h1>
                            <p class="text-dark">Thank you for your booking <br>

                                We have recieved your enquiry, Our team will contact you as soon as possible. <br>

                            </p><br>
                            <p class="text-dark">
                                Order ID :  {{@$payment->payable_id}} <br>
                                Amount : {{@$payment->net_amount_debit}} INR
                            </p>

                          
                            <div class="text-center breadcrumbs col-md-12"> 
                    <p class="text-white"><a href="{{ route('home') }}" style="background: #71779a;color: #fff;padding: 7px 30px;border-radius: 100px;margin-top: 10px;display: inline-block;">Home</a>                       
                    </p>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
