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
                    
                    <div class="hero__form carBooking">
                        <div class="text-center">
                            <i class="fa fa-exclamation-triangle"
                                style="color: #c72a2a;font-size: 50px;border-radius: 50px;background: #141414;padding: 15px;"></i>
                            <h1 class="text-center text-dark col-md-12 mt-4">Payment Failed</h1>
                            <p class="text-dark"> We are sorry to inform you that your recent payment attempt has failed <br>

                            </p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
