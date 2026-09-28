@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
<style>
    .table_payment{
        width:100%;
        margin:auto;
        text-align: center;
        margin-bottom: 10px;
        margin-top: 20px;
    }
    .table_td{
        text-align: left;
    }
    .hero__form.carBooking {
    background: #00000017;
}
    .razorpay-payment-button {
        color: #fff !important;
        text-transform: uppercase;
        text-decoration: none;
        background: #ED3330;
        padding: 20px 40px;
        border-radius: 5px;
        display: inline-block;
        border: none;
        transition: all 0.4s ease 0s;
        width: auto;
    }
    .razorpay-payment-button:hover {
        background: #434343;
        letter-spacing: 1px;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0, 0, 0, 0.57);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0, 0, 0, 0.57);
        box-shadow: 5px 40px -10px rgba(0, 0, 0, 0.57);
        transition: all 0.4s ease 0s;
    }
</style>
<section class="section page-content" data-setbg="{{ asset('assets/images/slider/car-booking.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 mt-2">
                {{-- @if($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong> {{ $message }}
            </div>
            @endif
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}"
                role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Success!</strong> {{ $message }}
            </div>
            @endif --}}
                <div class="hero__form carBooking tabbed-single-form pt-3 mt-0 pb-0">
                    <div class="card-body text-center">
                        <div class="col-lg-12 pb-1">
                            <p class="text-dark text-center"><b>BOOKING DETAILS</b></p>
                        </div>
                        <div class="text-center">
                            <table class="table_payment">
                                <tbody>
                                    <tr>
                                        <td style="padding: 10px;" class="table_td" width="40%">Vehicle</td>
                                        <td style="padding: 10px;" width="20%">:</td>
                                        <td style="padding: 10px;" class="table_td" width="40%">{{ $booking->vehicle->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;" class="table_td" width="40%">Name</td>
                                        <td style="padding: 10px;" width="20%">:</td>
                                        <td style="padding: 10px;" class="table_td" width="40%">{{ $booking->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;" class="table_td" width="40%">Email</td>
                                        <td style="padding: 10px;" width="20%">:</td>
                                        <td style="padding: 10px;" class="table_td" width="40%">{{ $booking->email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;" class="table_td" width="40%">Phone</td>
                                        <td style="padding: 10px;" width="20%">:</td>
                                        <td style="padding: 10px;" class="table_td" width="40%">{{ $booking->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;" class="table_td" width="40%">Amount</td>
                                        <td style="padding: 10px;" width="20%">:</td>
                                        <td style="padding: 10px;" class="table_td" width="40%"> ₹{{ $booking->vehicle->booking_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px;" class="table_td" width="40%">Payment Method</td>
                                        <td style="padding: 10px;" width="20%">:</td>
                                        <td style="padding: 10px;" class="table_td" width="40%"> RAZORPAY</td>
                                    </tr>
                                <tbody>
                            </table>
                        </div>
                        <div class="card-body text-center">
                            <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js" 
                                data-key="{{ env('RAZORPAY_KEY') }}"
                                data-amount="{{ $attributes['amount'] }}"
                                data-buttontext="Pay ₹ {{ $attributes['amount']/100 }}" data-name="{{ $attributes['name'] }}"
                                data-description="{{ $attributes['description'] }}" order_id="{{ $attributes['orderId'] }}"
                                data-image="{{ asset('assets/images/success.png') }}"
                                data-prefill.name="{{ $attributes['firstname'] }}"
                                data-prefill.email="{{ $attributes['email'] }}"
                                data-prefill.contact="{{ $attributes['phone'] }}" data-theme.color="#FA4251">
                            </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection