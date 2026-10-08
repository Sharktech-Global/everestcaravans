@extends('layouts.front')
@section('css_after')
<link rel="stylesheet" href="{{ asset('assets/abreco/css/vehicle.css') }}">
@endsection
@section('content')


    <!--====== Vehicle inner Breadcrumb Part ======-->
    <section class="abreco-inner-banner d-none-575" style="background-image: url('{{ asset('storage/' . @$vehicle->banner_image) }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}" alt="">
                        </div>
                        <h1>{{ @$vehicle->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- vehicle banner mobile view -->
    <section class="abreco-inner-banner abreco-inner-banner-2 d-none d-block-575" style="background-image: url('{{ asset('storage/' . @$vehicle->mobile_banner) }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <div class="baner-bg-head2">
                            <!-- <img src="{{ asset('assets/abreco/images/shapes/banner-head.png') }}" alt=""> -->
                        </div>
                        <h1>{{ @$vehicle->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== abreco Vehicle Overview tabs ======-->
    <section class="vehicle-data" id="vehicle-data">
        <div class="container">

            <!-- BREADCRUMBS START -->
            <!-- <div class="breadcrumb-wrapper">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('vehicle_type', $vehicle->vehicle_type->slug) }}">{{ @$vehicle->vehicle_type->name }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ @$vehicle->name }}</li>
                </ul>
            </div> -->
            <!-- BREADCRUMBS END -->

            <!-- DATA TABS START  -->
            <div class="details-tab-wrapper" id="link-scroll-data">
                <article class="tabbed-content">
                    <!-- desktop /Mobile  view -->
                    <nav class="tabs tabs-new-class">
                        <ul class="text-center">
                            <li>
                                <a href="#overview" id="overview-link" class="active">
                                    <!-- <img src="{{ asset('assets/abreco/images/vehicle-img/icon-overview.webp') }}"
                                        alt="" width="38" height="45" class="img-none-1065 img-none-575" /> -->
                                        Overview</a></li>
                            <li>
                                <a href="#specs" id="specifications-link">
                                    <!-- <img src="{{ asset('assets/abreco/images/vehicle-img/icon-specification.webp') }}"
                                        alt="" width="38" height="45" class="img-none-1065 img-none-575" /> -->
                                        specifications</a></li>
                            <li>
                                <a href="#external-gallery" id="external-gallery-link">
                                    <!-- <img src="{{ asset('assets/abreco/images/vehicle-img/icon-gallery.webp') }}" 
                                    alt="" width="38" height="45" class="img-none-1065 img-none-575" /> -->
                                    External Gallery</a></li>
                            <li>
                                <a href="#internal-gallery" id="internal-gallery-link">
                                    <!-- <img src="{{ asset('assets/abreco/images/vehicle-img/icon-gallery.webp') }}" 
                                    alt="" width="38" height="45" class="img-none-1065 img-none-575" /> -->
                                    Internal Gallery</a></li>
                            <li>
                                <a href="#floor-plans" id="floor-plans-link">
                                    <!-- <img 
                                    src="{{ asset('assets/abreco/images/vehicle-img/icon-gallery.webp') }}" 
                                    alt="" width="38" height="45" class="img-none-1065 img-none-575" /> -->
                                    Floor Plans</a></li>
                            @if ($vehicle->is_booking == '1')
                                <li>
                                    <a href="#booking" id="booking-link">
                                    <!-- <img src="{{ asset('assets/abreco/images/vehicle-img/icon-booking.webp') }}"
                                            alt="" width="38" height="45" class="img-none-1065 img-none-575" /> -->
                                            booking</a></li>
                            @endif
                            <!-- <li>
                                <a href="#gallery" id="gallery-link">
                                    <img 
                                    src="{{ asset('assets/abreco/images/vehicle-img/icon-gallery.webp') }}" 
                                    alt="" width="38" 
                                    height="45" 
                                    class="img-none-1065 img-none-575" />gallery
                                </a>
                            </li>
                            <li>
                                <a href="#features" id="features-link">
                                    <img 
                                    src="{{ asset('assets/abreco/images/vehicle-img/icon-features.webp') }}" 
                                    alt="" width="38" 
                                    height="45" 
                                    class="img-none-1065 img-none-575" />features
                                </a>
                            </li> -->

                        </ul>
                    </nav>

                    <!-- Mobile view new changes (Now Display NONe)-->
                    <nav class="tabs d-none tabs-second">
                        <ul class="text-center">
                            <li><a href="#overview-" class="active"><img
                                        src="{{ asset('assets/abreco/images/vehicle-img/icon-overview.webp') }}"
                                        alt="" width="38" height="45" class="img-none-575" />Overview</a></li>
                            <li><a href="#specs-"><img
                                        src="{{ asset('assets/abreco/images/vehicle-img/icon-specification.webp') }}"
                                        alt="" width="38" height="45" class="img-none-575" />specifications</a></li>
                            <li>
                                <a href="#external-gallery-">
                                    <img src="{{ asset('assets/abreco/images/vehicle-img/icon-specification.webp') }}"
                                    alt="" width="38" height="45" class="img-none-575" />External Gallery</a></li>
                            <li>
                                <a href="#internal-gallery-">
                                    <img src="{{ asset('assets/abreco/images/vehicle-img/icon-specification.webp') }}"
                                    alt="" width="38" height="45" class="img-none-575" />Internal Gallery</a></li>
                            <li>
                                <a href="#floor-plans-">
                                    <img src="{{ asset('assets/abreco/images/vehicle-img/icon-specification.webp') }}"
                                        alt="" width="38" height="45" class="img-none-575" />Floor Plans</a></li>
                            @if ($vehicle->is_booking == '1')
                                <li><a href="#booking-"><img
                                            src="{{ asset('assets/abreco/images/vehicle-img/icon-booking.webp') }}"
                                            alt="" width="38" height="45" class="img-none-575" />booking</a></li>
                            @endif
                            <!-- <li><a href="#gallery-"><img
                                        src="{{ asset('assets/abreco/images/vehicle-img/icon-gallery.webp') }}"
                                        alt="" width="38" height="45" class="img-none-575" />gallery</a></li>
                            <li><a href="#features-"><img
                                        src="{{ asset('assets/abreco/images/vehicle-img/icon-features.webp') }}"
                                        alt="" width="38" height="45" class="img-none-575" />features</a></li> -->

                        </ul>
                    </nav>

                    <!-- response menus -->
                    <!-- <div class="dropdown dropdown-border drop-1023 d-none mb-40">
                        <select class="mobile-dropdown mobile-dropdown2" id="mobile-selectr">
                            <option value="overview-">Overview</option>
                            <option value="features-">Features</option>
                            <option value="specifications-">Specifications</option>
                            <option value="gallery-">Gallery</option>
                            @if ($vehicle->is_booking == '1')
                                <option value="booking-">Booking</option>
                            @endif
                        </select>
                    </div> -->
                    
                    @if ($sections)
                        <section id="overview" class="item active">
                            <div class="item-content">
                                <div class="data">
                                    <h4 class="text-capitalize">{{ @$sections->title }}</h4>
                                    <p class="mb-5 inner-text">{{ @$sections->description }}</p>
                                    @if(@$vehicle->brochure)
                                    <div class="ab-button-wrapper"><a  href="{{ @$vehicle->brochure }}"
                                            class="ab-button" target="_blank">Download Brochure</a></div>
                                    @endif
                                </div>
                                <div class="image">
                                    <img src="{{ asset('storage/' . @$vehicle->image) }}" alt="" width=""
                                        height="" />
                                </div>
                            </div>
                        </section>
                    @endif
                    <section id="specs" class="item accordions spec-card" aria-labelledby="spec-chassis">
                        <div class="item-content">
                            <div class="data">
                                <h4 class="text-capitalize">Specifications</h4>
                                @if($vehicle->sections()->count())
                                    @foreach ($vehicle->sections()->orderBy('order')->get() as $section)
                                        @if($section->order == 2)
                                            <!-- <div class="gallery-grid">
                                                <h2 class="text-white mb-3">{{ $section->title }}</h2>
                                            </div> -->
                                            {!! $section->description !!}
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </section>
                    <section id="external-gallery" class="item accordions popgallery">
                        <div class="item-content">
                            <div class="data">
                                <h4 class="text-capitalize">External Gallery</h4>
                                @if($vehicle->sections()->count())
                                    @foreach ($vehicle->sections()->orderBy('order')->get() as $section)
                                        @if($section->order == 3)
                                            <div class="gallery-grid">
                                                <!-- <h2 class="text-white mb-3">{{ $section->title }}</h2>
                                                <p class="text-white mb-4">{{ htmlspecialchars_decode(strip_tags($section->description)) }}</p> -->
                                                @foreach ($section->images()->orderBy('order')->get() as $image)
                                                <div class="card">
                                                    <div class="card-image">
                                                        <a href="{{ asset('storage/'.$image->image) }}"
                                                            data-fancybox="external-gallery" data-caption="{{ @$image->title }}">
                                                            <img src="{{ asset('storage/'.$image->image) }}"
                                                                alt="{{ @$image->title }}">
                                                        </a>
                                                    </div>
                                                    <!-- <p>{{ @$image->title }}</p> -->
                                                </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </section>
                    <section id="internal-gallery" class="item accordions popgallery">
                        <div class="item-content">
                            <div class="data">
                                <h4 class="text-capitalize">Internal Gallery</h4>
                                @if($vehicle->sections()->count())
                                    @foreach ($vehicle->sections()->orderBy('order')->get() as $section)
                                        @if($section->order == 4)
                                            <div class="gallery-grid">
                                                <!-- <h2 class="text-white mb-3">{{ $section->title }}</h2>
                                                <p class="text-white mb-4">{{ htmlspecialchars_decode(strip_tags($section->description)) }}</p> -->
                                                @foreach ($section->images()->orderBy('order')->get() as $image)
                                                <div class="card">
                                                    <div class="card-image">
                                                        <a href="{{ asset('storage/'.$image->image) }}"
                                                            data-fancybox="internal-gallery" data-caption="{{ @$image->title }}">
                                                            <img src="{{ asset('storage/'.$image->image) }}"
                                                                alt="{{ @$image->title }}">
                                                        </a>
                                                    </div>
                                                    <!-- <p>{{ @$image->title }}</p> -->
                                                </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </section>
                    <section id="floor-plans" class="item accordions popgallery">
                        <div class="item-content">
                            <div class="data">
                                <h4 class="text-capitalize">floor-plans</h4>
                                @if($vehicle->sections()->count())
                                    @foreach ($vehicle->sections()->orderBy('order')->get() as $section)
                                        @if($section->order == 5)
                                            <div class="gallery-grid">
                                                <!-- <h2 class="text-white mb-3">{{ $section->title }}</h2>
                                                <p class="text-white mb-4">{{ htmlspecialchars_decode(strip_tags($section->description)) }}</p> -->
                                                @foreach ($section->images()->orderBy('order')->get() as $image)
                                                <div class="card">
                                                    <div class="card-image">
                                                        <a href="{{ asset('storage/'.$image->image) }}"
                                                            data-fancybox="floor-plans" data-caption="{{ @$image->title }}">
                                                            <img src="{{ asset('storage/'.$image->image) }}"
                                                                alt="{{ @$image->title }}">
                                                        </a>
                                                    </div>
                                                    <p>{{ @$image->title }}</p>
                                                </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </section>
                    <section id="booking" class="item booking web">
                        <!-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif -->
                        <div class="item-content">
                            <div class="image bg-color-3 br-10">
                                <h4 class="text-capitalize">Book Your {{@$vehicle->name}} Now</h4>
                                <p class="mb-0">{!!@$vehicle->description!!}
                                </p>
                                <p class="mb-0">(Please note that our booking form is currently undergoing development. No live payment transactions could be performed currently.)
                                </p>
                            </div>
                            <div class="data bg-color-3">
                                <form action="{{ route('vehicles.booking', $vehicle->slug) }}"
                                    id="form-submit-booking-web" method='post' class="w-100"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col first">
                                            <input type="text" class="form-control" name='name'
                                                placeholder="Your Name" aria-label="Your Name" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col second">
                                            <input type="text" class="form-control" placeholder="Model"
                                                aria-label="Model" disabled value="{{ @$vehicle->name }} " required>
                                            <input type="hidden" class="form-control" placeholder="Model"
                                                aria-label="Model" name="model" value="{{ @$vehicle->id }} ">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col first">
                                            <input type="text" class="form-control" name="pan"
                                                placeholder="PAN Number" aria-label="PAN Number" required>
                                        </div>
                                        <div class="col second">
                                            <select class="form-control" name="location" aria-label="Your Email ID"
                                                required>
                                                <option>Select Booking Location</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-file-upload-button">
                                                <input type="email" name='email' placeholder="Email"
                                                    aria-label="Email" class="form-control" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                {{-- <input type="file" name='proof' value="" id="actual-btn"  required/>
                                                <label for="actual-btn" class="col">Address Proof (<small> JPG / PNG
                                                        *</small>)</label>
                                                <span id="file-chosen">No file chosen </span>
                                                @error('proof.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">

                                        </div>
                                        <div class="col button-wrapper">
                                            <button type="submit">Book Your Vehicle</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section> 
                    <!-- <section id="features" class="item accordions">
                        <div class="item-content">
                            <div class="data">
                                <h4 class="text-capitalize">{{ @$vehicle->name }} Features</h4>
                                <div class="accordion" id="accordionExample">
                                    @if ($features->count() > 0)
                                        @foreach ($features as $key => $feature)
                                            <div class="card card-accord">
                                                <div class="card-header" id="heading_{{ $key }}">
                                                    
                                                        <button type="button" class="accordion-btn" data-toggle="collapse"
                                                            data-target="#collapse_{{ $key }}"><i
                                                                class="fa fa-plus"></i>{{ @$feature->title }}</button>
                                                     
                                                </div>
                                                <div id="collapse_{{ $key }}"
                                                    class="collapse @if ($key == 0) show @endif"
                                                    aria-labelledby="heading_{{ $key }}"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        @if(@$feature->details)
                                                            <p>{!! @$feature->details !!}</p>
                                                         @elseif(@$feature->image_files)
                                                         <div class="row">
                                                            <div class="col-md-4"> 
                                                                <img src="{{asset('storage/'.@$feature->image_files->image)}}">
                                                            </div>

                                                         </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $key = $key + 1;
                                            @endphp
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section> -->
                    <!-- <section id="gallery" class="item">
                        <div class="item-content">
                            <div class="data w-100" style="padding-right: 0;">
                                <h4 class="text-capitalize">{{ @$vehicle->name }} Image Gallery</h4>
                                <main class="mains">
                                    <div class="containers">
                                        @if ($galleries)
                                            @foreach ($galleries as $gallery)
                                                <div class="card">
                                                    <div class="card-image">
                                                        <a href="{{ asset('upload/vehicle/gallery/' . $gallery->image) }}"
                                                            data-fancybox="gallery" data-caption="{{ @$gallery->title }}">
                                                            <img src="{{ asset('upload/vehicle/gallery/' . $gallery->image) }}"
                                                                alt="{{ @$gallery->title }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </main>
                            </div>
                        </div>
                    </section> -->                 
                </article>
            </div>
            <!-- DATA TABS END -->
        </div>
    </section>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

@section('js_after')
    <script>
        $(document).ready(function() {
            $('.floatingButton').on('click', function(e) {
                e.preventDefault();
                $(this).toggleClass('open');
                var icon = $(this).find('.fa');

                if (icon.hasClass('fa-ellipsis-h')) {
                    icon.removeClass('fa-ellipsis-h');
                    icon.addClass('fa-times');
                } else if (icon.hasClass('fa-times')) {
                    icon.removeClass('fa-times');
                    icon.addClass('fa-ellipsis-h');
                }

                $('.floatingMenu').stop().slideToggle();
            });

            $(this).on('click', function(e) {
                var container = $(".floatingButton");
                if (!container.is(e.target) && $('.floatingButtonWrap').has(e.target).length === 0) {
                    if (container.hasClass('open')) {
                        container.removeClass('open');
                    }
                    var icon = container.find('.fa');
                    if (icon.hasClass('fa-times')) {
                        icon.removeClass('fa-times');
                        icon.addClass('fa-ellipsis-h');
                    }
                    $('.floatingMenu').hide();
                }

                if (!container.is(e.target) && ($('.floatingMenu').has(e.target).length > 0)) {
                    $('.floatingButton').removeClass('open');
                    $('.floatingMenu').stop().slideToggle();
                }
            });
        });
    </script>
    <!-- veicle details js -->
    <script>
        tabControl();

        var resizeTimer;
        $(window).on('resize', function(e) {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                tabControl();
            }, 250);
        });

        function tabControl() {
            var tabs = $('.tabbed-content').find('.tabs');
            if (tabs.is(':visible')) {
                tabs.find('a').on('click', function(event) {
                    event.preventDefault();
                    var target = $(this).attr('href'),
                        tabs = $(this).parents('.tabs'),
                        buttons = tabs.find('a'),
                        item = tabs.parents('.tabbed-content').find('.item');
                    buttons.removeClass('active');
                    item.removeClass('active');
                    $(this).addClass('active');
                    $(target).addClass('active');
                });
            } else {
                $('.item').on('click', function() {
                    var container = $(this).parents('.tabbed-content'),
                        currId = $(this).attr('id'),
                        items = container.find('.item');
                    container.find('.tabs a').removeClass('active');
                    items.removeClass('active');
                    $(this).addClass('active');
                    container.find('.tabs a[href$="#' + currId + '"]').addClass('active');
                });
            }
        }

        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
                // "slideShow",
                "thumbs",
                "zoom",
                "fullScreen",
                "share",
                "close"
            ],
            loop: false,
            protect: true
        });

        const actualBtn = document.getElementById('actual-btn');
        const fileChosen = document.getElementById('file-chosen');
        actualBtn.addEventListener('change', function() {
            fileChosen.textContent = this.files[0].name
        })
    </script>

    <!-- Accordion -->
    <script>
        $(document).ready(function() {
            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function() {
                $(this)
                    .prev(".card-header")
                    .find(".fa")
                    .addClass("fa-minus")
                    .removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse")
                .on("show.bs.collapse", function() {
                    $(this)
                        .prev(".card-header")
                        .find(".fa")
                        .removeClass("fa-plus")
                        .addClass("fa-minus");
                })
                .on("hide.bs.collapse", function() {
                    $(this)
                        .prev(".card-header")
                        .find(".fa")
                        .removeClass("fa-minus")
                        .addClass("fa-plus");
                });
        });
    </script>

    <script>
        $("#mobile-selectr").change(function() {
            const selectedValue = $(this).val();
            $(`#${selectedValue}-tab`).addClass("active");
            $('.tab-pane').removeClass('show active');
            $(`#${selectedValue}`).addClass('show active');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#form-submit-booking-web').submit(function(e) {
                e.preventDefault(); // Prevent the form from submitting via the browser

                // Serialize the form data
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('vehicles.booking', $vehicle->slug) }}',
                    data: formData,
                    success: function(response) {
                        if (response.redirect_url) {
                            // Redirect to the provided URL
                            window.location.href = response.redirect_url;
                        } else {
                            // Handle other success cases or display a message
                            console.log('Form submitted successfully.');
                        }
                    },
                    error: function(xhr) {
                        // Handle errors and validation errors
                        if (xhr.status === 422) {
                            var errors = JSON.parse(xhr.responseText).errors;
                            // Loop through the errors and display them next to the respective form fields
                            $.each(errors, function(field, message) {
                                // Append the error message to the respective form field container
                                $('input[name="' + field + '"]').after(
                                    '<span class="text-danger">' + message[0] +
                                    '</span>'
                                );
                            });
                        } else {
                            // Handle other errors
                            console.log(xhr.responseText);
                        }
                    }
                });
            });
        });
    </script>
    <!-- table js -->
    <script>
       $(document).ready(function() {
            $('.table-responsive-stack').each(function() {
                var id = $(this).attr('id');

                $(this).find("th").each(function(i) {
                    var headerText = $(this).text();
                    $('#' + id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">' + headerText + '</span> ');
                });

                // Hide all but the first span in each td
                $('#' + id + ' td span.table-responsive-stack-thead:not(:first-child)').hide();
            });

            $('.table-responsive-stack').each(function() {
                var thCount = $(this).find("th").length;
                var rowGrow = 100 / thCount + '%';
                $(this).find("th, td").css('flex-basis', rowGrow);
            });

            function flexTable() {
                if ($(window).width() < 768) {
                    $(".table-responsive-stack").each(function() {
                        $(this).find(".table-responsive-stack-thead:not(:first-child)").hide();
                        $(this).find('thead').hide();
                    });
                } else {
                    $(".table-responsive-stack").each(function() {
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

    </script>

    <!-- fixed menus -->
    <script>
         window.onscroll = function() {
            var header = document.querySelector('.tabs-new-class');
            if (window.pageYOffset <= header.offsetTop) {
                header.classList.remove('fixed');
            } else {
                header.classList.add('fixed');
            }
        };
      
        // You can adjust the screen width threshold as needed
            $("#overview-link").on("click", function(event) {
                event.preventDefault(); // Prevent the default behavior of the anchor link

                // Get the target section by its id
                const targetSection = $("#link-scroll-data");
                if ($(window).width() <= 768) { 
                    if (targetSection.length) {
                        // Use the `animate` function to scroll to the section with a smooth effect
                        $("html, body").animate({
                            scrollTop: targetSection.offset().top
                        }, 100); // You can adjust the animation speed (in milliseconds)
                    }
                }
            });
            $("#features-link").on("click", function(event) {
                event.preventDefault(); // Prevent the default behavior of the anchor link

                // Get the target section by its id
                const targetSection = $("#link-scroll-data");
                if ($(window).width() <= 768) { 
                    if (targetSection.length) {
                        // Use the `animate` function to scroll to the section with a smooth effect
                        $("html, body").animate({
                            scrollTop: targetSection.offset().top
                        }, 100); // You can adjust the animation speed (in milliseconds)
                    }
                }
            });
            $("#specifications-link").on("click", function(event) {
                event.preventDefault(); // Prevent the default behavior of the anchor link

                // Get the target section by its id
                const targetSection = $("#link-scroll-data");
                if ($(window).width() <= 768) { 
                    if (targetSection.length) {
                        // Use the `animate` function to scroll to the section with a smooth effect
                        $("html, body").animate({
                            scrollTop: targetSection.offset().top
                        }, 100); // You can adjust the animation speed (in milliseconds)
                    }
                }
            });
            $("#gallery-link").on("click", function(event) {
                event.preventDefault(); // Prevent the default behavior of the anchor link

                // Get the target section by its id
                const targetSection = $("#link-scroll-data");
                if ($(window).width() <= 768) { 
                    if (targetSection.length) {
                        // Use the `animate` function to scroll to the section with a smooth effect
                        $("html, body").animate({
                            scrollTop: targetSection.offset().top
                        }, 100); // You can adjust the animation speed (in milliseconds)
                    }
                }
            });
            $("#booking-link").on("click", function(event) {
                event.preventDefault(); // Prevent the default behavior of the anchor link

                // Get the target section by its id
                const targetSection = $("#link-scroll-data");
                if ($(window).width() <= 768) { 
                    if (targetSection.length) {
                        // Use the `animate` function to scroll to the section with a smooth effect
                        $("html, body").animate({
                            scrollTop: targetSection.offset().top
                        }, 100); // You can adjust the animation speed (in milliseconds)
                    }
                }
            });
        
    </script>
    
@endsection
