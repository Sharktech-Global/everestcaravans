@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/career.css') }}">
@endsection
@section('content')
    <!-- BANNER -->
        <section class="page-banner" style="background: url('{{ asset('assets/front/banner/careers.jpg') }}') no-repeat center center; background-size: cover;">
            <div class="container text-center">
                <span class="text-white title">SEND ENQUIRY</span>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"> <span><a class="text-white" 
                                href="{{ route('home') }}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>SEND ENQUIRY</span></p>
                </div>
            </div>
        </section>               


        <section class="section" id="enquiry_mainform" style="background: url('{{asset('assets/front/images/BGpattern.svg')}}') top left;background-color: #000;">
            <div class="container">
                {{-- <h3 class="title text-white text-center mb-4">BOOK A SERVICE</h3> --}}
                <div class="hero__form carBooking">
                    <div>
                        @include('forms.send_enquiry')
                    </div>
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
        </section>
    {{-- END BOOKING FORM --}}
@endsection
@section('js_after')
    <script>
       function career_data(id){
        $.ajax({
                type: 'GET',
                url: "careers/change",
                data: {
                    "id": id
                },
                dataType: "json",
                success: function(response) {
                    $('#career_openings').empty();
                    if (response.careers) {
                        var formoption;
                        formoption = "<option value=''>Select Opening</option>";
                        $.each(response.careers, function(v) {
                            console.log(response.careers);
                            if(response.careers[v].id == id) {
                                formoption += "<option selected value='" + response.careers[v].id + "'>" + response.careers[v].title + "</option>";

                            } else {
                                formoption += "<option value='" + response.careers[v].id + "'>" + response.careers[v].title + "</option>";

                            }
                        });
                           
                    }
                    $("#career_openings").html(formoption);
                }
            });
       }
    </script>
@endsection
