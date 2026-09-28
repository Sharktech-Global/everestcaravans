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


    <body>
    <section class="pt-5 pb-5 mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">



                    <h2 class="pb-4 mb-1 text-center font-weight-bold text-dark">Payment Request</h2>
                    <div class="float-left pt-3 col-md-12">
                        <p class="float-left pb-4 mb-2 mb-5 text-center w-100 text-primary fs-20">
                            To complete the process, please proceed
                            with payment.
                        </p>
                    </div>

                    <div class="m-auto col-md-8 col-md-offset-4">
                        <table class="table table-striped table-kaf" align="left">
                            <tr>
                                <th>
                                    <p>Amount</p>
                                </th>
                                <td>
                                    <p>Rs. {{ $attributes['amount']/100 }}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <p>Phone</p>
                                </th>
                                <td>
                                    <p>{{$attributes['phone']}}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <p>Name</p>
                                </th>
                                <td>
                                    <p>{{ $attributes['firstname'] }}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <p>Email</p>
                                </th>
                                <td>
                                    <p>{{ $attributes['email'] }}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <p>Payment Status</p>
                                </th>
                                <td>
                                    @if (session('error'))
                                        <p class="text-danger">{{ session('error') }}</p>
                                    @else
                                        <p class="text-warning">Pending</p>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <div class="float-left pt-3 col-md-12 payment-message bg-info">
                            <p class="text-center mb-2 text-white w-100">Keep your Debit / Credit card ready to make the payment</p>
                        </div>

                        <form id="AWLPGPost" action="{{ $action_url }}" method="POST"
                            class="float-left mt-4 text-center w-100">
                            <input type="hidden" name="merchantRequest" value="{{ $merchantRequest }}" />
                            <input type="hidden" name="MID" value="{{ $reqMsgDTO->getMid() }}" />
                            <input style="height:50px;inportant!" id="payment_wordline" type="submit" onclick="payment_button();"  name="checkout" class="payment-message bg-info btn-primary"
                                value="Proceed to Payment">
                                <span id="loading_message" class="d-none">Please wait while we are processing your request.Do not close this window...</span>
                        </form>

                    </div>
                </div>
            </div>
    </section>
@section('header-class')
    success-header
@endsection
@section('js_after')
    <script type="text/javascript">
        //submit the form to the worldline
        //document.txnSubmitFrm.submit();
        function payment_button(){
            $('#payment_wordline').addClass('d-none');
            $('#loading-bar-spinner').removeClass('d-none');
            $('#loading_message').removeClass('d-none')
        }

    </script>
@endsection
