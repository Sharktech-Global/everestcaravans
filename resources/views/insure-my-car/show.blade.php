@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
    <!-- BANNER -->
    <section class="page-banner" style="background: url('{{ asset('assets/front/images/Abreco-insurancer01.jpg') }}') no-repeat top right; background-size: cover;">
        <div class="container text-center">
            <span class="text-white title">INSURE MY CAR</span>
            <div class="text-center breadcrumbs col-md-12">
                <p class="text-dark"> <span><a class="text-dark" 
                            href="{{ route('home') }}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                        aria-hidden="true"></i> <span>INSURE MY CAR</span></p>
            </div>
        </div>
    </section>
<!-- END BANNER -->
{{-- BOOKING FORM --}}
    <section class="section" id="insurance_form" style="background: url('{{asset('assets/front/images/BGpattern.svg')}}') top left;background-color: #000;">
        <div class="container">
            {{-- <h3 class="title text-white text-center mb-4">INSURE MY CAR</h3> --}}
            <div class="hero__form carBooking mt-0">
                <div id="insure_mainform">
                    @include('forms.insurance_form')
                </div>
                {{-- <div class="d-none" id="service-otp-div">
                    @include('forms.otp_form')
                </div> --}}
            </div>
        </div>
    </section>
{{-- END BOOKING FORM --}}

@endsection
@section('js_after')
<script>
    $("#insurance-location").select2();
</script>
    <script>
        $(document).ready(function() {
            $('.formPageName').val("insure");
            $('#insurance-form').parsley();
            $('#insurance-form').on('submit', function(event) {
                event.preventDefault();
                if ($('#insurance-form').parsley().isValid()) {
                    $.ajax({
                        url: "{{ route('sent_otp_insurance') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            if (data.status) {
                                $("#insure-otp-div").removeClass("d-none");
                                $("#insure_mainform").addClass("d-none");
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
