@extends('layouts.app')
@section('css_after')

@endsection

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay" data-setbg="{{ asset('assets/images/background/book-online.jpg') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">Coming Soon</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Coming Soon</span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-5 bg-black">
            {{-- <div class="container pt-5 mb-4">
                <div class="row">
                    <div class="offset-md-3 col-md-6">
                        <p class="text-center">
                            <b>Coming Soon</b><br>
                            Something awesome is coming soon.
                        </p>
                    </div>
                </div>
            </div> --}}

            <!-- ABOUT -->
            <div class="container contactPremier">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero__form carBooking bg-white tabbed-single-form">
                            {{-- <h3 class="text-left"><span class="text-primary">QUICK ENQUIRY</span></h3> --}}
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
                            <div id="validation-error" class="d-none">
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <p class="mb-0">{{ session('error') }}</p>
                                </div>
                            </div>
                            <div id="buynewcar_mainform">
                            @include('forms.buynewcar_form')
                            </div>
                            <div class="d-none enter-otp-div">
                                @include('forms.otp_form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END ABOUT -->
        </section>
    </main>
@endsection
@section('js_after')
    <script>
        $("#buynewcarloc").select2();
        $(document).ready(function() {
            $('#buynewcar-form').parsley();
            $('#buynewcar-form').on('submit', function(event) {
                event.preventDefault();
                if ($('#buynewcar-form').parsley().isValid()) {
                    $.ajax({
                        url: "{{ route('sent_otp_buy_new_car') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            if (data.status) {
                                $(".enter-otp-div").removeClass("d-none");
                                $("#buynewcar_mainform").addClass("d-none");
                                $(".mode").val(data.mode);
                                $(".enquiry_id").val(data.id);
                            } else {
                                if(data.message == 'Failed to send OTP') {
                                    var validation = '';
                                        validation = validation +
                                            '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p class="mb-0">' +
                                                data.message + '</p></div>';
                                    $("#validation-error").removeClass("d-none");
                                    $("#validation-error").html(validation);
                                } else {
                                    var validation = '';
                                    jQuery.each(data.message, function(index, item) {
                                        validation = validation +
                                            '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p class="mb-0">' +
                                            item + '</p></div>';
                                    });
                                    $("#validation-error").removeClass("d-none");
                                    $("#validation-error").html(validation);
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
