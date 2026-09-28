@extends('layouts.front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/vehicle.css') }}">
    <style>
        main {
            padding-top: 90px;
        }

        @media (min-width: 1200px) and (max-width: 1600px) {
            main {
                padding-top: 75px;
            }
        }

        @media (min-width: 767px) and (max-width: 1200px) {
            main {
                padding-top: 70px;
            }
        }

        @media (max-width: 767px) {
            main {
                padding-top: 45px;
            }
        }
        @media(max-width: 575px){
            .bread-inner h1{
                margin-top: -75px
            }
        }
    </style>
@endsection
@section('content')
    <!--====== contact Breadcrumb Part ======-->
    <section class="abreco-inner-banner position-relative" style="background-image: url('{{ asset('storage/' . @$Vtype->image) }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner bread-inner-contact">
                        <div class="baner-bg-head2">
                            <img src="assets/images/shapes/banner-head.png" alt="">
                        </div>
                        <h1>{{@$Vtype->name}} @if($vehicle_application_name) - {{@$vehicle_application_name->name}} @endif</h1>                   
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking Search -->
        <div class="booking-wrapper">
            <form action="{{ route('vehicle_search') }}" method="POST">
                @csrf
                <div class="form-control">
                    <select name="type" id="vehicle_type" required>
                        <option value="">Select Type</option>
                        @foreach ($vehicle_types_data as $type)
                            <option  @if($type->id == @$Vtype->id) selected  @endif value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control">
                    <select name="vehicleApplications" id="vehicleApplications">
                        <option value="">Select Application</option>
                        @foreach ($application_list as $list)
                            <option  @if(@$vehicle_application_name->id == @$list->id) selected  @endif value="{{ $list->id }}">{{ $list->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-control form-control-submit">
                    <input type="submit" value="Search" name="submit">
                </div>
            </form>
        </div>
    </section>
   
    <!--====== vehicles details ======-->
    <section class="abreco-features-area pt-130 pb-100" id="content-scroll">
        <div class="container">
            <!-- BREADCRUMBS START -->
            <div class="breadcrumb-wrapper">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a >{{@$Vtype->name}} @if($vehicle_application_name) - {{@$vehicle_application_name->name}} @endif</a>
                    </li>
                </ul>
            </div>
            <!-- BREADCRUMBS END -->

            <div class="row" id="content">
                @if($vehicle_list->count())
                @foreach ($vehicle_list as $vehicle_data)
                    <div class="col-lg-3 mb-3 box">
                        <div class="fea-inner">
                            <div class="img">
                                <a href="{{ route('vehicles.show', @$vehicle_data->slug) }}">
                                <img src="{{ asset('storage/' . $vehicle_data->image) }}" alt="">
                                </a>
                            </div>
                            <div class="inner-details">
                                <h3>{{ $vehicle_data->name }}</h3>
                                <p>{!! \Illuminate\Support\Str::limit(@$vehicle_data->tagline, $limit = 80, $end = '...') !!}</p>
                                {{-- <p>{!! $vehicle_data->tagline !!}</p> --}}
                                <div class="inner-btn flex-wrap mt-3">
                                    <a href="{{route('vehicles.show',@$vehicle_data->slug)}}" class="first-btn">View More</a>
                                    {{-- <a href="{{route('enquiry.index',@$vehicle_data->slug)}}" class="sec-btn">Enquire Now</a> --}}
                                      <a href="#" class="sec-btn openPop" data-toggle="modal" data-target="#form-Popup" >Enquire Now</a>
                                                            <input type='hidden' class='vehicle-id' value="{{$vehicle_data->slug}}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="col-lg-12">
                    <h3 class="text-center"> No Vehicles Found !</h3>                    
                </div>
               
                @endif
                <div class="col-lg-12 text-center primary-btn-main">
                    <a class="new-btn-style btn-vehicle-back" id='viewMore' href="{{route('home')}}"> <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21"
                        height="14" viewBox="0 0 21 14" fill="none">
                        <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <img src="{{ asset('assets/abreco/images/shapes/right-white.png') }}"
                        class="d-none white" alt=""> Go Back</a>                    
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-12 text-center">
                    <div class="feature-mobile-btn mt-60 mb-40">
                        <!-- <button id="load-more">Load More</button> -->
                        <div class="primary-btn-main">
                            <a href="" class=" new-btn-style" id="load-more">
                                <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14" viewBox="0 0 21 14" fill="none">
                                    <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> 
                                <img src="{{asset('assets/abreco/images/shapes/right-white.png')}}" class="d-none white" alt="">
                                Load More</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection
@section('js_after')
<script>
    $(document).ready(function () {
        // Handler for .ready() called.
        $('html, body').animate({
            scrollTop: $('#content-scroll').offset().top
        },10);
    });

    $('#vehicle_type').on('change', function() {
                var selectedType = $(this).val();
                // alert(selectedType);
                // Make an Ajax request to fetch vehicles based on the selected type
                if(selectedType){
                    $.ajax({
                        url: '{{ route('get-vehicle-application', ':type') }}'.replace(':type',
                            selectedType),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Clear the current options in the second select element
                            $('#vehicleApplications').empty();
                            $('#vehicleApplications').append(
                                '<option value="">Select Application</option>');

                            // Populate the second select element with retrieved vehicles
                            $.each(data, function(index, vehicle) {
                                $('#vehicleApplications').append('<option value="' + vehicle
                                    .id + '">' + vehicle.name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Error loading vehicle application.');
                        }
                    });
                }
            });

            $('#vehicle_type_mobile').on('change', function() {
                var selectedType = $(this).val();
                // alert(selectedType);
                // Make an Ajax request to fetch vehicles based on the selected type
                $.ajax({
                    url: '{{ route('get-vehicle-application', ':type') }}'.replace(':type',
                        selectedType),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Clear the current options in the second select element
                        $('#vehicleApplicationsmobile').empty();
                        $('#vehicleApplicationsmobile').append(
                            '<option value="">Select Application</option>');
                        // Populate the second select element with retrieved vehicles
                        $.each(data, function(index, vehicle) {
                            $('#vehicleApplicationsmobile').append('<option value="' +
                                vehicle.id + '">' + vehicle.name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Error loading vehicle application.');
                    }
                });
            });
        
</script>

@endsection
