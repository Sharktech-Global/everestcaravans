@extends('layouts.app')

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ @$page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/images/background/default.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">Buy a Used Car</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Buy a Used Car</span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-0 bg-black">

            <!-- CARRER VACCANCIES -->
            <div class="container pt-5">
                {{-- <div class="row">
                <div class="col-lg-6">
                    {!! @$page->content !!}
                    @if (@$page->background_image)
                    <img alt="Request a test drive" title="Request a test drive" src="{{ asset('storage/'.@$page->background_image) }}" class="pt-4 mt-5 pos-abs pos-btm pos-mob">
                    @endif
                </div> --}}
                <div class="mt-0 mb-5 bg-white col-lg-12 tabbed-single-form" id='contact'>
                    <div class="bg-white hero__form carBooking mt-0">
                        <h3><span class="text-primary">BUY A USED CAR</span></h3>
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
                        <div id="buyusedcar_mainform">
                            @include('forms.buyusedcar_form')
                        </div>
                        <div class="d-none" id="buyusedcar-otp-div">
                            @include('forms.otp_form')
                        </div>
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
        $(document).ready(function() {
            loadlocation('normal');
            $('#buyusedcar-form').parsley();
            $('#buyusedcar-form').on('submit', function(event) {
                event.preventDefault();
                if ($('#buyusedcar-form').parsley().isValid()) {
                    $.ajax({
                        url: "{{ route('sent_otp_usedcar') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            if (data.status) {
                                $("#buyusedcar-otp-div").removeClass("d-none");
                                $("#buyusedcar_mainform").addClass("d-none");
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
