@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
 <!-- BANNER -->
 <section class="page-banner" style="background: url('{{ asset('assets/front/banner/Book-test-drive.jpg') }}') no-repeat center center; background-size: cover;">
    <div class="container text-center">
        <span class="text-white title">TEST DRIVE</span>
        <div class="text-center breadcrumbs col-md-12">
            <p class="text-white"> <span><a class="text-white" 
                        href="{{ route('home') }}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                    aria-hidden="true"></i> <span>TEST DRIVE</span></p>
        </div>
    </div>
</section>
<!-- END BANNER -->

{{-- BOOKING FORM --}}
<section class="section"  id="test_drive_mainform" style="background: url('{{asset('assets/front/images/BGpattern.svg')}}') top left;background-color: #000;">
    <div class="container">
        {{-- <h3 class="title text-white text-center mb-4">INSURE MY CAR</h3> --}}
        <div class="hero__form carBooking mt-0">
            <div>
                @include('forms.test_drive')
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
        $(document).ready(function() {
            $('#testdrive-form').parsley();
            $('#testdrive-form').on('submit', function(event) {
                event.preventDefault();
                if ($('#testdrive-form').parsley().isValid()) {
                    $.ajax({
                        url: "{{ route('sent_otp_test_drive') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            if (data.status) {
                                $("#testdrive-otp-div").removeClass("d-none");
                                $("#testdrive_mainform").addClass("d-none");
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
