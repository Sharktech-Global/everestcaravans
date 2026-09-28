@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/vehicle.css') }}">
    <style>
        main {
            padding-top: 180px;
        }
        .tab-container .tab-content .card .card-body {
            overflow-x: scroll;
        }
        @media (min-width: 1200px) and (max-width: 1600px) {
            main {
                padding-top: 155px;
            }
        }
        @media (min-width: 767px) and (max-width: 1200px) {
            main {
                padding-top: 145px;
            }
        }
        @media (max-width: 767px) {
            main {
                padding-top: 90px;
            }
        }
    </style>
@endsection
@section('content')

    {{-- BANNER --}}
    <section class="vehicle-banner"
        style="background: url('{{ $vehicle->banner_image ? asset('storage/' . $vehicle->banner_image) : asset('assets/images/background/default.jpg') }}') no-repeat center center; background-size: cover;">
        <div class="container">
            <div class="vehicle-title">
                <h3>ALL NEW</h3>
                <h2>{{ $vehicle->name }}</h2>
            </div>
        </div>
    </section>
    {{-- END BANNER --}}

    <div id="sticky-anchor1"></div>
    <section id="sticky1" class="stick1">
        <div class="container">
            <header>
                <div class="logo">
                    <a href="#"></a>
                </div>
                <nav id="mainNav">
                    <a class="navigation__link" href="#overview">Overview</a>
                    <a class="navigation__link" href="#specifications">Specifications</a>
                    <a class="navigation__link" href="#colors">Colors</a>
                    <a class="navigation__link" href="#test-drive">Send Enquiry</a>
                    @if($vehicle->brochure)<a class="navigation__link" target="_blank" href="{{ $vehicle->brochure}}">Download Brochure</a>@endif
                </nav>
                <div class="lang">
                    <!-- @if($vehicle->is_booking == '1')<a href="{{ route('booking.show',$vehicle->slug) }}">Book Online</a>@endif -->
                </div>
            </header>
        </div>
    </section>
    <section id="mobile-sticky">
        <ul>
            <li><a class="navigation__link" href="#test-drive">Send Enquiry</a></li>
            @if($vehicle->brochure)<li><a class="navigation__link" target="_blank" href="{{$vehicle->brochure }}">Download Brochure</a></li>@endif
            <!-- <li><a href="{{ route('booking.show',$vehicle->slug) }}">Book Online</a></li> -->
        </ul>
    </section>

    {{-- <div  class="anchorid" style="position: relative;"></div> --}}
    @if ($vehicle->sections()->count())
        @php
            $new_section = $vehicle->sections()
                                    ->with('images')
                                    ->where('order', 10)
                                    ->orderBy('order')
                                    ->first();
        @endphp
        @if ($new_section)
            <section class="technology section">
                <div class="container">
                    <h2 class="title" style="text-align: center;">{!! @$new_section->title !!}</h2>
                    <div class="sub-title">{!! @$new_section->description !!}</div>
                    <div class="row">
                        @foreach ($new_section->images()->orderBy('order')->get() as $section_image)
                            <div class="col">
                                <div class="box text-center">
                                    <img src="{{ asset('storage/' . $section_image->image) }}" alt="Abreco"
                                        height="45.07px" width="34.35px" /><br>
                                    {!! $section_image->description !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif

    {{-- @if($vehicle->slug == "grand-vitara")
        <section class="hybrid section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 hyb1">
                        <img src="{{ asset('assets/front/images/INTELLIGENT-ELECTRIC-HYBRID.webp') }}" height="auto"
                            width="100%" alt="Abreco" />
                        <h2 class="title text-dark">INTELLIGENT <br>ELECTRIC HYBRID</h2>
                        <div>Lorem ipsum dolor sit amet, consectetur adipis cing elit. Integer consectetur luctus hendrerit.
                        </div>
                        <button type="button" class="btn btn-danger hybrid1-btn">DETAILS</button>
                    </div>
                    <div class="col-sm-6 hyb2">
                        <img src="{{ asset('assets/front/images/SMART-HYBRID.webp') }}" height="auto" width="100%"
                            alt="Abreco" />
                        <h2 class="title text-dark">SMART <br>HYBRID</h2>
                        <div>Lorem ipsum dolor sit amet, consectetur adipis cing elit. Integer consectetur luctus hendrerit.
                        </div>
                        <button type="button" class="btn btn-danger hybrid2-btn">DETAILS</button>
                    </div>
                </div>
            </div>
        </section>
    @endif --}}

    @if ($vehicle->sections()->count())
        @php  $i=0; @endphp
        @foreach ($vehicle->sections()->with('images')->where('order', '!=', 10)->orderBy('order')->get() as $section)
            @php
                $key_class = $i % 2;
            @endphp
            @if ($key_class == 0)
                <section id="overview"  class="even-section vehicle-content exterior section"
                    style="background: url('{{ asset('assets/front/images/pattern-exterior.webp') }}') no-repeat center center; background-size: cover; background-color:#0c0c0c">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-7 vehicle-data">
                                <h3 class="title text-white">{!! @$section->title !!}</h3>
                                {{-- {!!@$section->description!!} --}}
                                <div>{!!@$section->description!!}
                                </div>
                            </div>
                            <div class="col-sm-5 vehicle-images">
                                <div class="contain">
                                    <div class="owl-carousel owl-theme owl-carousel-nexa">
                                        @if ($section->images()->count() > 0)
                                            @foreach ($section->images as $image)
                                                <div class="item">
                                                    <img src="{{ asset('storage/' . $image->image) }}" height="auto"
                                                        width="100%" alt="Abreco" />
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <section class="odd-section vehicle-content interior section"
                    style="background: url('{{ asset('assets/front/images/interior.webp') }}') no-repeat center center; background-size: cover; background-color:#2b3447">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5 vehicle-images">
                                <div class="contain1">
                                    <div class="owl-carousel owl-theme owl-carousel-nexa">
                                        @if ($section->images()->count() > 0)
                                            @foreach ($section->images as $image)
                                                <div class="item">
                                                    <img src="{{ asset('storage/' . $image->image) }}" height="auto"
                                                        width="100%" alt="Abreco" />
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7 vehicle-data">
                                <h2 class="title text-white">{!! @$section->title !!}</h2>
                                {{-- {!!@$section->description!!} --}}
                                <div>{!!@$section->description!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            @php $i=$i+1; @endphp
        @endforeach
    @endif

    <!-- FEATURES -->
    @if ($vehicle->allfeatures()->count())
        <section class="client-testimonials section bg-dark" style="padding-top: 4rem;">
            <div class="container">
                <div class="testimonial">
                    <h2 class="title text-white text-center">FEATURES</h2>
                    
                    <div class="owl-carousel owl-theme owl-carousel-nexa-feature">
                        @foreach ($vehicle->allfeatures()->with('image_files')->get() as $key =>  $section_features)
                            @foreach($section_features->image_files as $image)
                                <div class="item" style="flex-direction: column;">
                                    <img src="{{asset('storage/'.$image->image)}}" height="auto"
                                        width="100%" alt="Abreco" />
                                    <div class="text-white" style="font-size: 18px;">{{@$section_features->title}}</div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
	<!-- END FEATURES -->

    {{-- technical and features --}}
    @if (($category_types_specs->count() > 0) || ($category_types_features->count() > 0))
        <section  id="specifications" class="vehicle-content features section">
            <div class="container">
                <h2 class="title text-dark text-center">TECHNICAL <br> SPECIFICATIONS & FEATURES</h2>
                <div class="sub-title">
                </div>

                <div class="tab-container">
                    <div class="tabs">
                        <button class="tab active">Technical</button>
                        <button class="tab non-active">Features</button>
                    </div>
                    <div class="tab-content">
                        @if ($category_types_specs->count() > 0)
                            @foreach ($category_types_specs as $category_type)
                                <div class="card">
                                    @foreach ($category_type->categories()->where('status', 1)->orderBy('name')->get() as $category)
                                        @if ($vehicle_details->where('category_type_id', $category_type->id)->where('category_id', $category->id)->count())
                                            <div class="card-header" id="heading{{ $category->id }}">
                                                <button class="btn btn-link w-100" data-toggle="collapse"
                                                    data-target="#collapse{{ $category->id }}" aria-expanded="true"
                                                    aria-controls="collapse{{ $category->id }}">{{ $category->name }}<i class="fa fa-angle-down"></i></button>
                                            </div>

                                            <div id="collapse{{ $category->id }}" class="collapse"
                                                aria-labelledby="heading{{ $category->id }}"
                                                data-parent="#accordionCarCategories">
                                                <div class="card-body">
                                                    <table
                                                        class="table table-bordered table-striped table-responsive-stack"
                                                        id="table-{{ $category->id }}">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th > </th>
                                                                @foreach ($category->subCategories()->where('status', 1)->orderBy('name')->get() as $subcat)
                                                                    @if ($vehicle_details->where('category_type_id', $category_type->id)->where('category_id', $category->id)->where('sub_category_id', $subcat->id)->count())
                                                                        <th>{{ @$subcat->name }}</th>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        </thead>

                                                        <tbody class="thead-dark">
                                                            @foreach ($vehicle->varients()->get() as $variant)
                                                                @php
                                                                    $details = $vehicle_details
                                                                        ->where('category_type_id', $category_type->id)
                                                                        ->where('category_id', $category->id)
                                                                        ->where('sub_category_id', $subcat->id)
                                                                        ->where('vehicle_variant_id', $variant->id)
                                                                        ->first();
                                                                @endphp
                                                                <tr>
                                                                    <th >{{ $variant->name }}</th>
                                                                    @foreach ($category->subCategories()->where('status', 1)->orderBy('name')->get() as $subcat1)
                                                                        @if ($vehicle_details->where('category_type_id', $category_type->id)->where('category_id', $category->id)->where('sub_category_id', $subcat1->id)->count())
                                                                            @php
                                                                                $details1 = $vehicle_details
                                                                                    ->where('category_type_id', $category_type->id)
                                                                                    ->where('category_id', $category->id)
                                                                                    ->where('sub_category_id', $subcat1->id)
                                                                                    ->where('vehicle_variant_id', $variant->id)
                                                                                    ->first();
                                                                            @endphp
                                                                            @if (@$details1->is_boolean == 1)
                                                                                <td>
                                                                                    @if (@$details1->status == 0)
                                                                                        <i class="fa fa-check primaryColor"
                                                                                            aria-hidden="true"></i>
                                                                                    @elseif(@$details1->status == 1)
                                                                                        <i class="fa fa-minus "
                                                                                            aria-hidden="true"></i>
                                                                                    @endif
                                                                                </td>
                                                                            @else
                                                                                <td>
                                                                                    @if (@$details1->details)
                                                                                        {{ @$details1->details }}
                                                                                    @else
                                                                                        <i class="fa fa-minus "
                                                                                            aria-hidden="true"></i>
                                                                                    @endif
                                                                                </td>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="tab-content hidden">
                        @if ($category_types_features->count() > 0)
                            @foreach ($category_types_features as $category_type)
                                <div class="card">
                                    @foreach ($category_type->categories()->where('status', 1)->orderBy('name')->get() as $category)
                                        @if ($vehicle_details->where('category_type_id', $category_type->id)->where('category_id', $category->id)->count())
                                            <div class="card-header" id="heading{{ $category->id }}">
                                                <button class="btn btn-link w-100" data-toggle="collapse"
                                                    data-target="#collapse{{ $category->id }}" aria-expanded="true"
                                                    aria-controls="collapse{{ $category->id }}">{{ $category->name }}<i class="fa fa-angle-down"></i></button>
                                            </div>

                                            <div id="collapse{{ $category->id }}" class="collapse"
                                                aria-labelledby="heading{{ $category->id }}"
                                                data-parent="#accordionCarCategories">
                                                <div class="card-body">
                                                    <table
                                                        class="table table-bordered table-striped table-responsive-stack"
                                                        id="table-{{ $category->id }}">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th > </th>
                                                                @foreach ($category->subCategories()->where('status', 1)->orderBy('name')->get() as $subcat)
                                                                    @if ($vehicle_details->where('category_type_id', $category_type->id)->where('category_id', $category->id)->where('sub_category_id', $subcat->id)->count())
                                                                        <th>{{ @$subcat->name }}</th>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        </thead>

                                                        <tbody class="thead-dark">
                                                            @foreach ($vehicle->varients()->get() as $variant)
                                                                @php
                                                                    $details = $vehicle_details
                                                                        ->where('category_type_id', $category_type->id)
                                                                        ->where('category_id', $category->id)
                                                                        ->where('sub_category_id', $subcat->id)
                                                                        ->where('vehicle_variant_id', $variant->id)
                                                                        ->first();
                                                                @endphp
                                                                <tr>
                                                                    <th >{{ $variant->name }}</th>
                                                                    @foreach ($category->subCategories()->where('status', 1)->orderBy('name')->get() as $subcat1)
                                                                        @if ($vehicle_details->where('category_type_id', $category_type->id)->where('category_id', $category->id)->where('sub_category_id', $subcat1->id)->count())
                                                                            @php
                                                                                $details1 = $vehicle_details
                                                                                    ->where('category_type_id', $category_type->id)
                                                                                    ->where('category_id', $category->id)
                                                                                    ->where('sub_category_id', $subcat1->id)
                                                                                    ->where('vehicle_variant_id', $variant->id)
                                                                                    ->first();
                                                                            @endphp
                                                                            @if (@$details1->is_boolean == 1)
                                                                                <td>
                                                                                    @if (@$details1->status == 0)
                                                                                        <i class="fa fa-check primaryColor"
                                                                                            aria-hidden="true"></i>
                                                                                    @elseif(@$details1->status == 1)
                                                                                        <i class="fa fa-minus "
                                                                                            aria-hidden="true"></i>
                                                                                    @endif
                                                                                </td>
                                                                            @else
                                                                                <td>
                                                                                    @if (@$details1->details)
                                                                                        {{ @$details1->details }}
                                                                                    @else
                                                                                        <i class="fa fa-minus "
                                                                                            aria-hidden="true"></i>
                                                                                    @endif
                                                                                </td>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </section>
    @endif
    <section id="colors" class="vehicle-content colors section">
        <div class="container">
            <h2 class="title text-dark text-center">COLORS</h2>
            @if ($vehicle->colors()->count())
                <section id="choose-colors">
                    <div class="container">
                        <div class="color-bg" style="background: url('{{ asset('assets/front/images/colors-bg.png') }}') no-repeat center center; background-size: cover;"></div>
                        <div id="tabs" class="text-center">
                            <div class="px-3 tab-content px-sm-0" id="nav-tabContent1">
                                @foreach ($vehicle->colors()->orderBy('order')->get() as $color)
                                    <div class="tab-pane fade show @if ($loop->first) active @endif"
                                        id="nav-{{ $color->id }}" role="tabpanel"
                                        aria-labelledby="nav-{{ $color->id }}-tab">
                                        <img class="w-100" src="{{ asset('storage/' . $color->image) }}"
                                            alt="{{ $color->name }}" title="{{ $color->name }}">
                                        <small class="float-left text-center w-100">{{ $color->name }}</small>
                                    </div>
                                @endforeach
                            </div>
                            <nav class="mt-2 w-100 all-colors">
                                <div class="text-center d-inline-block nav nav-tabs nav-fill w-100 border-0"
                                    id="nav-tab" role="tablist">

                                    @foreach ($vehicle->colors()->orderBy('order')->get() as $color)
                                        <a style="flex: unset;"
                                            class="d-inline-block nav-item nav-link @if ($loop->first) active @endif"
                                            id="nav-{{ $color->id }}-tab" data-toggle="tab"
                                            href="#nav-{{ $color->id }}" role="tab"
                                            aria-controls="nav-{{ $color->id }}" aria-selected="true">
                                            {{-- {{dd($color->color)}} --}}
                                            @if (count($color->color) == 1)
                                                <div class="single-color"
                                                    style="background: {{ $color->color[1] }};width: 45px; height: 45px;">
                                                </div>
                                            @elseif(count($color->color) == 2)
                                                <div class="dual-color"
                                                    style="background: linear-gradient(90deg, {{ $color->color[1] }} 0%, {{ $color->color[1] }} 52%, {{ $color->color[2] }} 52%, {{ $color->color[2] }} 100%);width: 45px; height: 45px;">
                                                </div>
                                            @endif
                                            {{-- <div style="background: {{ $color->color[1] }};display: inline-block;
                                        border-top: 35px solid #ef6d3b;border-right: 35px solid #64605f;"></div> --}}
                                            {{-- @if (isset($color->color[1]))
                                            <div style="background: {{ $color->color[1] }};"></div>
                                        @endif
                                        @if (isset($color->color[2]))
                                            <div style="background: {{ $color->color[2] }};"></div>
                                        @endif --}}
                                        </a>
                                    @endforeach

                                </div>
                            </nav>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </section>
    <div id="test-drive" class="anchorid" style="position: relative;"></div>
        <section class="vehicle-content section"
            style="background: url('{{ asset('assets/front/images/BGpattern.svg') }}') top left;background-color: #000;">
            <div class="container">
                <h2 class="title text-center text-white">GET IN TOUCH</h2>
                <div class="sub-title text-white text-center">
                </div>
                <div class="hero__form carBooking">
                    <div id="service_mainform">
                        @include('forms.testdrive_form')
                    </div>
                </div>
            </div>
        </section>
            {{-- <form>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" class="form-control" id="phone" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="city">City</label>
                            <select class="form-control" id="city" required>
                                <option></option>
                                <option>city1</option>
                                <option>city2</option>
                                <option>city3</option>
                                <option>city4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="car">Selected Car</label>
                            <select class="form-control" id="car" required>
                                <option></option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="color">Color</label>
                            <select class="form-control" id="color" required>
                                <option></option>
                                <option>Black</option>
                                <option>Blue</option>
                                <option>Grey</option>
                                <option>Red</option>
                                <option>White</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row checkbox">
                    <div class="col-sm-12">
                        <label><input type="checkbox" class="chkbox">I agree that by clicking the ‘Submit’ button below,
                            I am explicitly soliciting a call and message via whatsapp and any other medium from Abreco Motors.
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default register-btn">Submit</button>
                </div>
            </form> --}}
        </div>
    </section>

    <!--END BLOG -->
@endsection
@section('js_after')
<script>
    $('.owl-carousel.owl-theme.owl-carousel-nexa').owlCarousel({
  loop: true,
  margin: 20,
  dots: false,
  nav: false,
  items: 1,
  autoplay: true,
  responsive:{
    0:{
        items:1,
        nav:false
    },
    500:{
        items:1,
        nav:false
    }
  }
});


$('.owl-carousel.owl-theme.owl-carousel-nexa-feature').owlCarousel({
  loop: true,
  margin: 20,
  dots: false,
  nav: false,
  items: 1,
  autoplay: true,
  responsive:{
    0:{
        items:1,
        nav:false
    },
    500:{
        items:3,
        nav:false
    }
  }
});

        // RESPONSIVE TABLE
        $(document).ready(function() {
            $('.table-responsive-stack').each(function(i) {
                var id = $(this).attr('id');
                $(this).find("th").each(function(i) {
                    $('#' + id + ' td:nth-child(' + (i + 1) + ')').prepend(
                        '<span class="table-responsive-stack-thead">' + $(this).text() +
                        ':</span> ');
                    $('.table-responsive-stack-thead').hide();
                });
            });

            $('.table-responsive-stack').each(function() {
                var thCount = $(this).find("th").length;
                var rowGrow = 100 / thCount + '%';
                $(this).find("th, td").css('flex-basis', rowGrow);
            });

            function flexTable() {
                if ($(window).width() < 768) {
                    $(".table-responsive-stack").each(function(i) {
                        $(this).find(".table-responsive-stack-thead").show();
                        $(this).find('thead').hide();
                    }); 
                } else {
                    $(".table-responsive-stack").each(function(i) {
                        $(this).find(".table-responsive-stack-thead").hide();
                        $(this).find('thead').show();
                    });
                }
            }
            flexTable();
            window.onresize = function(event) {
                flexTable();
            };
        });
        $('.tab-container .tab-content .card .card-header button').click(function(){
            $(this).toggleClass('opened');
        });
</script>
@endsection