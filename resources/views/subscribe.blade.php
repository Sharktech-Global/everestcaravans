@extends('layouts.app')
@section('css_after')
    <style>
        .tabbed-single-form {
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">Subscribe</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Subscribe</span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-0 bg-black">
            <div class="container pt-5">
            <div class="mt-0 mb-0 bg-white col-lg-12 tabbed-single-form" id=' '>
                    <div class="bg-white hero__form carBooking">
                        <h3><span class="text-primary">SUBSCRIBE FOR NEW CAR</span></h3>
                        <div id="subscribe_mainform">
                            @include('forms.subscribe_form')
                        </div>
                        {{-- <div class="d-none" id="subscribe-otp-div">
                            @include('forms.otp_form')
                        </div> --}}
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
                    </div>
                </div>

                
            </div>
        </section>
    </main>
@endsection
@section('js_after')
    <script>
         $("#location").select2();
        $(document).ready(function() {
            // $('#subscribe-form').parsley();
            // $('#subscribe-form').on('submit', function(event) {
            //     event.preventDefault();
            //     if ($('#subscribe-form').parsley().isValid()) {
            //         $.ajax({
            //             url: "{{ route('sent_otp_subscribe') }}",
            //             method: "POST",
            //             data: $(this).serialize(),
            //             success: function(data) {
            //                 if (data.status) {
            //                     $("#subscribe-otp-div").removeClass("d-none");
            //                     $("#subscribe_mainform").addClass("d-none");
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
