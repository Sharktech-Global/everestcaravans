@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ $offer->banner_image ? asset('storage/' . $offer->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="text-center row">
                <h1 class="text-center text-white col-md-12">Offer</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i>
                        <span>Offer</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-0 bg-black">
            <!-- ABOUT -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="text-center">
                            {!! @$offer->content !!}
                        </p>
                    </div>
                </div>
            </div>
            <!-- END ABOUT -->
            <!-- CARRER VACCANCIES -->
            <div class="container contactPremier">
                <div class="row">
                    <div class="bg-white col-lg-12">
                        <div class="bg-white hero__form carBooking tabbed-single-form mt-4 pt-0">
                            {{-- <h3><span class="text-primary">OFFERS</span></h3> --}}
                            <div id="offer_mainform">
                                @include('forms.offer_form')
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
                            <div id="validation-error" class="d-none">
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <p class="mb-0">{{ session('error') }}</p>
                                </div>
                            </div>
                            {{-- <div class="d-none" id="offer-otp-div">
                                @include('forms.otp_form')
                            </div> --}}
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
    $("#location").select2();
</script>
    <script>
        $(document).ready(function() {
            $('#select-model').select2();
            $('#offer-form').parsley();
            // $('#offer-form').on('submit', function(event) {
            //     event.preventDefault();
            //     if ($('#offer-form').parsley().isValid()) {
            //         $.ajax({
            //             url: "{{ route('sent_otp_offer') }}",
            //             method: "POST",
            //             data: $(this).serialize(),
            //             success: function(data) {
            //                 if (data.status) {
            //                     $("#offer-otp-div").removeClass("d-none");
            //                     $("#offer_mainform").addClass("d-none");
            //                     $(".mode").val(data.mode);
            //                     $(".enquiry_id").val(data.id);
            //                 } else {
            //                     if(data.message == 'Failed to send OTP') {
            //                         var validation = '';
            //                             validation = validation +
            //                                 '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p class="mb-0">' +
            //                                     data.message + '</p></div>';
            //                         $("#validation-error").removeClass("d-none");
            //                         $("#validation-error").html(validation);
            //                     } else {
            //                         var validation = '';
            //                         jQuery.each(data.message, function(index, item) {
            //                             validation = validation +
            //                                 '<div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><p class="mb-0">' +
            //                                 item + '</p></div>';
            //                         });
            //                         $("#validation-error").removeClass("d-none");
            //                         $("#validation-error").html(validation);
            //                     }
            //                 }
            //             }
            //         });
            //     }
            // });
        });
    </script>
@endsection
