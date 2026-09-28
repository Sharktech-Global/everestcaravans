@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/images/background/default.png') }}">
        <h1 class="text-center text-white col-md-12"></h1>
        <div class="container">
            <div class="text-center row">
                <h1 class="text-center text-white col-md-12">TALK TO CEO</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i>
                        <span>Talk To CEO</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->
    <main id="content">

        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row justify-content-left mt-5 text-center col-md-12 pb-5">
                        <h2>Letter from
                          the CEO</h2>
                      </div>
                  </div>
                <div class="text-center col-md-12 pb-5">

                    <p class="text-left">
                        Dear Stakeholders,
                    </p>
                    <p class="text-left">
                        Greetings from Kuttukaran & Popular Vehicles & Services.
                    </p>
                    <p class="text-left">
                        We are pleased to inform you that the Kuttukaran group is entering its 80 years of excellence in business.
                        The group had its origin in the year 1939 as an entrepreneurial venture started by the Late Mr. K.P Paul.
                        From a family-run entity, it has grown into a professionally managed, multi-dimensional corporate house.
                    </p>
                    <p class="text-left">
                        Popular Vehicles and Services was amongst the first batch of dealers appointed by Maruti Suzuki in the
                        country and is one of the largest networks for Maruti in India today, consisting of 7 Dealerships,
                        5 NEXA outlets , 40 Service centers, 6 Used car outlets and 7 Driving schools.
                    </p>
                    <p class="text-left">
                        The success of any organization depends on valuable customers like you. We feel accomplished when we are
                        able to meet your expectations. We hope to retain this precious relationship in future as well.
                        Whenever you feel that we need to bring in some changes in the quality of work we deliver,
                        we would be more than happy to receive your valuable suggestions.
                    </p>
                    <p class="text-left">
                        Please feel free to interact with me by submitting the form below. Thank you.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row justify-content-center">
                      <h2>TALK TO CEO</h2>
                    </div>
                  </div>
                <div class="mt-0 mb-5 bg-white col-lg-12 tabbed-single-form" id='contact'>
                    <div class="bg-white hero__form carBooking">
                        <div id="service_mainform">
                            @include('forms.talktoceo_form')
                        </div>
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
                        {{-- <div class="d-none" id="service-otp-div">
                            @include('forms.otp_form')
                        </div> --}}
                        <div id="validation-error" class="d-none">
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <p class="mb-0">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="text-center col-md-12 pb-5">
                    <p class="text-left">
                        Thank you for being a trusted companion and for the tremendous support you have shown us as a valued Popular customer.
                        We are continuing our journey to bring you more outstanding services in line with the Kuttukaran culture.Pleasure to Journey with you
                    </p>
                    <p class="text-left">
                        Chief Executive Officer
                    </p>
                </div>

        </div>

    </main>
@endsection

@section('js_after')
    <script>
    $(document).ready(function() {
        $(".service-book-select").select2();

            $('#talktoceo-form').parsley();
            $('#talktoceo-form').on('submit', function(event) {
                event.preventDefault();
                if ($('#talktoceo-form').parsley().isValid()) {
                    $.ajax({
                        url: "{{ route('talk-to-ceo-send') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            if (data.status) {
                                $("#service-otp-div").removeClass("d-none");
                                $("#service_mainform").addClass("d-none");
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
