@extends('layouts.front')
@section('css_after')
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    <section class="abreco-inner-banner ken-burn"  style="background-image: url('{{ asset('storage/' . @$group->banner_image) }}');">
        <div class="about-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}" alt="">
                        </div>
                        <h1>Our Range</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="abreco-features-area pt-130 pb-100" id="Features">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-3">
                    <div class="abreco-features-tabs-btn aftb">
                        <div class="nav nav-pills flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($vehicle_types_data as $type)
                                <a class="nav-link type-cliker  @if ($loop->first) first-nav-link active @else nav-link-{{ $loop->iteration }} @endif"
                                    id="v-pills-{{ $type->slug }}-tab " clicker="{{ $type->slug }}" data-toggle="pill"
                                    href="#v-pills-{{ $type->slug }}" role="tab"
                                    aria-controls="v-pills-{{ $type->slug }}" aria-selected="true">
                                    <span>{{ $type->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="abreco-features-tabs-btn aftb dropdown dropdown-border drop-991 d-none mb-40">
                        <div class="nav nav-pills flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($vehicle_types_data as $type)
                                <a class="nav-link type-cliker  @if ($loop->first) first-nav-link active @else nav-link-{{ $loop->iteration }} @endif"
                                    id="v-pills-{{ $type->slug }}-tab " clicker="{{ $type->slug }}"
                                    data-toggle="pill" href="#v-pills-{{ $type->slug }}" role="tab"
                                    aria-controls="v-pills-{{ $type->slug }}" aria-selected="true">
                                    <span>{{ $type->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        @foreach ($vehicle_types_data as $type)
                            <div class="tab-pane fade @if ($loop->first) show active @else fade @endif "
                                id="v-pills-{{ $type->slug }}" role="tabpanel"
                                aria-labelledby="v-pills-{{ $type->slug }}-tab">
                                <div class="row" id="content">
                                    {{-- Filter vehicles for the current type --}}
                                    @php
                                        $vehicles_under_type = App\Vehicle::where('vehicle_type_id', $type->id)
                                            ->select('slug', 'tagline', 'name', 'image')
                                            ->where('status', 1)
                                            ->orderBy('order','ASC')
                                            ->take(8)
                                            ->get();
                                    @endphp
                                    {{-- Display vehicles for the current type --}}
                                    @foreach ($vehicles_under_type as $vehicle_data)
                                        <div class="col-lg-4 mb-3 box">
                                            <div class="fea-inner">
                                                <div class="img">
                                                   <a href="{{ route('vehicles.show', @$vehicle_data->slug) }}">
                                                   <img src="{{ asset('storage/' . @$vehicle_data->image) }}"
                                                        alt="abreco">
                                                   </a>
                                                </div>
                                                <div class="inner-details">
                                                    <h3><a href="{{ route('vehicles.show', @$vehicle_data->slug) }}">{{ @$vehicle_data->name }}</a></h3>
                                                    <p>{!! \Illuminate\Support\Str::limit(@$vehicle_data->tagline, $limit = 80, $end = '...') !!}</p>
                                                    {{-- <p>{!! @$vehicle_data->tagline !!}</p> --}}
                                                    <div class="inner-btn flex-wrap mt-3">
                                                        <a href="{{ route('vehicles.show', @$vehicle_data->slug) }}"
                                                            class="first-btn">View More</a>
                                                        <!-- <a href="{{ route('enquiry.index', @$vehicle_data->slug) }}"
                                                            class="sec-btn">Enquire Now</a> -->
                                                            <!-- <a href="#" class="sec-btn openPop" data-toggle="modal" data-target="#form-Popup" >Enquire Now</a> -->
                                                            <input type='hidden' class='vehicle-id' value="{{$vehicle_data->slug}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- <div class="row">
                        <div class="col-12 text-center">
                            <div class="feature-mobile-btn mt-60 mb-40">
                                <div class="primary-btn-main">
                                    @php
                                        $type_first = @$vehicle_types_data[0];
                                    @endphp
                                    <a href="{{ route('vehicle_type', @$type_first->slug) }}" class=" new-btn-style"
                                        id="viewMore">
                                        <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21"
                                            height="14" viewBox="0 0 21 14" fill="none">
                                            <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <img src="{{ asset('assets/abreco/images/shapes/right-white.png') }}"
                                            class="d-none white" alt="">
                                        View More</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js_after')
    <script></script>
@endsection
