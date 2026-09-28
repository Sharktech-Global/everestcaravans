@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')

    <!-- BANNER -->
    <section class="page-banner"  style="background: url('{{ $addPage->banner_image ? asset('storage/' . $addPage->banner_image) : asset('assets/images/background/default.png') }}') no-repeat center center; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title">{{ $addPage->title }}</span>
            <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"> <span><a class="text-white"  href="{{route('home')}}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span><a class="text-white"  href="{{route('our-services.show')}}">Services</a></span> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i><span>{{ $addPage->title }}</span> </p>
                </div>
        </div>
    </section>
    <!-- END BANNER -->
    
    <main id="content">

        <!-- CONTENT -->
       {{--  @if($addPage->content && $addPage->content != "NULL")
            <section class="section" style="background-image: url('{{asset('assets/front/images/pattern3.svg')}}');">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-dark text-center">{{ $addPage->title }}</h2> 
                            <p class="text-white">
                                {!! $addPage->content !!}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        @else --}}
            <section class="bg-black" style="background-image: url('{{asset('assets/front/images/pattern3.svg')}}');">
                <!-- LEADERSHIP TEAM -->
                <div class="container py-4">
                    <div class="row">
                        <div class="col-md-12">
                        <h3 class="text-center text-dark mt5 mb5">COMING SOON...</h3>
                        </div>
                    </div>
                </div>
                <!-- END LEADERSHIP TEAM -->
            </section>
        {{-- @endif --}}
        <!-- END CONTENT -->

        {{-- BOOKING FORM --}}
        <section id="our_service_form" class="section" style="background: url('{{asset('assets/front/images/BGpattern.svg')}}') top left;background-color: #000;">
            <div class="container">
                <h3 class="title text-white text-center mb-4">BOOK A SERVICE</h3>
                <div class="hero__form carBooking">
                    <div id="service_mainform">
                        @include('forms.services_form')
                    </div>
                    {{-- <div class="d-none" id="service-otp-div">
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
        </section>
        {{-- END BOOKING FORM --}}

    </main>
@endsection
@section('js_after')
<script>
    $("#service_location").select2();
</script>
    <script>
        $(function() {
            $(".service_date").datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: 0,
                autoSize: true,
                changeMonth: true,
                changeYear: true,
                yearRange: "-0:+5",
                onClose: function() {
                    $(this).parsley().validate();
                }
            });
        });
        $(document).ready(function() {
            $('.formPageName').val("{{ $addPage->slug }}");
            $('#services-form').parsley();
            $('#services-form').on('submit', function(event) {
                event.preventDefault();
                if ($('#services-form').parsley().isValid()) {
                    $.ajax({
                        url: "{{ route('sent_otp_services_form') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            if (data.status) {
                                $("#service-otp-div").removeClass("d-none");
                                $("#service_mainform").addClass("d-none");
                                $(".mode").val(data.mode);
                                $(".enquiry_id").val(data.id);
                            } else {
                                if (data.message == 'Failed to send OTP') {
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