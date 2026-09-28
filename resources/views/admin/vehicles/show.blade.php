@extends('layouts.app')

@section('content')
<!-- BANNER -->
<section class="hero set-bg cardetailpage" data-setbg="{{ asset('storage/'.$vehicle->banner_image) }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__form">
                    <h3>Know<br><span>MORE</span></h3>
                    <form action="#" class="call__form">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="text" placeholder="Email">
                            </div>
                            <div class="form-group col-lg-12">
                                <input type="text" placeholder="Phone">
                            </div>
                            <div class="form-group col-lg-12">
                                <select style="display: none;">
                                    <option value="">Location</option>
                                </select>
                                <div class="nice-select" tabindex="0">
                                    <span class="current">Location</span>
                                    <ul class="list">
                                        <li data-value="" class="option selected">Location 1</li>
                                        <li data-value="" class="option selected">Location 2</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="text-center"><button type="submit" class="site-btn">GET IN TOUCH</button></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__text">
                    <h2>{{ $vehicle->title }}</h2>
                    <h3>{!! $vehicle->tagline !!}</h3>
                    <a href="#" class="primary-btn">BOOK NOW</a>
                </div>
            </div>
        </div>
    </div>
</section>
@if($vehicle->sections()->count())
<main id="content" class="mobilecenter">
    <section class="bg-black">
        @foreach ($vehicle->sections()->orderBy('order')->get() as $section)
        @if($section->order == 1)
        <!-- EXTERIOR -->
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-white mb-3">{{ $section->title }}</h2>
                    <p class="text-white">{!! $section->description !!}</p>
                </div>
            </div>
        </div>
        <!-- END EXTERIOR -->
        <!-- CHOOSE COLOR & EXPLORE -->
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 mb-5">
                    <h2 class="text-white mb-3">CHOOSE COLOR</h2>
                    <div id="tabs">
                        <div class="tab-content px-3 px-sm-0" id="nav-tabContent">
                            @foreach ($vehicle->colors()->get() as $color)
                            <div class="tab-pane fade show @if($loop->first) active @endif" id="nav-{{ $color->id }}"
                                role="tabpanel" aria-labelledby="nav-{{ $color->id }}-tab">
                                img loading="lazy"
                                src="{{ asset('storage/'.$color->image) }}"><small>{{ $color->name }}</small>
                            </div>
                            @endforeach
                        </div>
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                @foreach ($vehicle->colors()->get() as $color)
                                <a class="nav-item nav-link @if($loop->first) active @endif"
                                    id="nav-{{ $color->id }}-tab" data-toggle="tab" href="#nav-{{ $color->id }}"
                                    role="tab" aria-controls="nav-{{ $color->id }}" aria-selected="true">
                                    <div style="background: {{ $color->color }};"></div>
                                </a>
                                @endforeach
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="offset-lg-1 col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-5">
                    <h2 class="text-white mb-3">EXPLORE</h2>
                    @foreach ($section->images()->orderBy('order')->get() as $image)
                    <img alt="Abreco" class="pt-65" src="{{ asset('storage/'.$image->image) }}">
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @if($section->order == 2)
        <!-- INTERIOR -->
        <div class="container mb-5 pb-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-white mb-3">{{ $section->title }}</h2>
                    <p class="text-white mb-4">{!! $section->description !!}</p>
                    <div class="customer-logos slider lightbox">
                        @foreach ($section->images()->orderBy('order')->get() as $image)
                        <div class="slide">
                            <a href="{{ asset('storage/'.$image->image) }}" data-toggle="lightbox"
                                data-gallery="gallery" class="col-md-12">
                                <img alt="Abreco" src="{{ asset('storage/'.$image->image) }}" class="img-fluid
                                rounded">
                                <p>{{ $image->description }}</p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- END INTERIOR -->
        @endif
        @if($section->order == 3)
        <!-- SPACIOUS INTERIORS -->
        <div class="container mb-5 pb-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-white mb-3">{{ $section->title }}</h2>
                    <p class="text-white mb-4">{!! $section->description !!}</p>
                </div>
                <div class="w-100 px-3">
                    @foreach ($section->images()->orderBy('order')->get() as $image)
                    @if($loop->first)
                    <div class="col-lg-9 col-md-8 col-sm-6 col-xs-12 p-0 float-left h-100">
                        <img alt="Abreco" class="w-100 h-100" src="{{ asset('storage/'.$image->image) }}">
                    </div>
                    @else
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-0 float-left">
                        <img alt="Abreco" class="" src="{{ asset('storage/'.$image->image) }}">
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- END SPACIOUS INTERIORS -->
        @endif
        @if($section->order == 4)
        <!-- CONNECTIVITY -->
        <div class="container mb-5 pb-5 connectivity">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-white mb-3">{{ $section->title }}</h2>
                    <p class="text-white mb-4">{!! $section->description !!}</p>
                </div>
                <div class="w-100 px-3">
                    @foreach ($section->images()->orderBy('order')->get() as $image)
                    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 p-0 float-left h-100 mb-2">
                        <img alt="Abreco" class="w-100 h-100" src="{{ asset('storage/'.$image->image) }}">
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 float-left pl-5 mb-2">
                        {!! $image->description !!}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- END CONNECTIVITY -->
        @endif
        @if($section->order == 5)
        <!-- ENGINE AND PERFORMANCE -->
        <div class="container mb-5 pb-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-white mb-3">{{ $section->title }}</h2>
                </div>
                <div class="w-100 px-3">
                    @foreach ($section->images()->orderBy('order')->get() as $image)
                    @if($loop->first)
                    <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12 p-0 float-left h-100">
                        <div class="posab">
                            {!! $image->description !!}
                        </div>
                        <img alt="Abreco" class="" src="{{ asset('storage/'.$image->image) }}">
                    </div>
                    @else
                    <div class="col-lg-8 col-md-12 col-sm-6 col-xs-12 float-left bg-676767 py-4">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img alt="Abreco" class="" src="{{ asset('storage/'.$image->image) }}">
                            </div>
                            <div class="col-md-8 pt-80">
                                {!! $image->description !!}
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- END ENGINE AND PERFORMANCE -->
        @endif
        @if($section->order == 6)
        <!-- SAFETY -->
        <div class="container mb-5 pb-5 safety">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-white mb-3">{{ $section->title }}</h2>
                    <p class="text-white">{!! $section->description !!}</p>
                    @foreach ($section->images()->orderBy('order')->get() as $image)
                    @if($loop->first)
                    <div class="col-lg-8 col-md-12 col-sm-6 col-xs-12 float-left">
                        <img alt="Abreco" class="" src="{{ asset('storage/'.$image->image) }}">
                    </div>
                    @else
                    <div class="col-lg-2 col-md-12 col-sm-3 col-xs-12 float-left">
                        <img alt="Abreco" class="" src="{{ asset('storage/'.$image->image) }}">
                        <p class="text-white lh-18 mt-1">{!! $image->description !!}</p>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- END SAFETY -->
        @endif
        @endforeach
        <!-- FEATURES & SPECIFICATIONS -->
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-white mb-3">FEATURES & SPECIFICATIONS</h2>

                    <div id="ftabs" class="mt-5">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-features-tab" data-toggle="tab"
                                    href="#nav-features" role="tab" aria-controls="nav-features" aria-selected="true">
                                    <h3 class="text-white">FEATURES</h3>
                                </a>
                                <a class="nav-item nav-link" id="nav-specifications-tab" data-toggle="tab"
                                    href="#nav-specifications" role="tab" aria-controls="nav-specifications"
                                    aria-selected="false">
                                    <h3 class="text-white">SPECIFICATIONS</h3>
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content px-3 px-sm-0" id="nav-tabContent">
                            <!-- contents for features tab -->
                            <div class="tab-pane fade show active" id="nav-features" role="tabpanel"
                                aria-labelledby="nav-features-tab">
                                <div id="accordion">
                                    @foreach ($vehicle->features()->get() as $feature)
                                    <div class="card">
                                        <div class="card-header" id="{{ $feature->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link text-white text-white"
                                                    data-toggle="collapse" data-target="#collapse{{ $feature->id }}"
                                                    aria-expanded="true"
                                                    aria-controls="collapse{{ $feature->id }}">{{ $feature->feature->name }}
                                                    <i class="fa fa-plus"></i></button>
                                            </h5>
                                        </div>
                                        <div id="collapse{{ $feature->id }}"
                                            class="collapse @if($loop->first) show @endif"
                                            aria-labelledby="{{ $feature->id }}" data-parent="#accordion">
                                            <div class="card-body">
                                                {!! $feature->value !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- end contents for features tab -->
                            <!-- contents for specification tab -->
                            <div class="tab-pane fade" id="nav-specifications" role="tabpanel"
                                aria-labelledby="nav-specifications-tab">
                                <div id="faccordion">
                                    @foreach ($vehicle->specifications()->get() as $specs)
                                    <div class="card">
                                        <div class="card-header" id="{{ $specs->id }}">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link text-white text-white"
                                                    data-toggle="collapse" data-target="#collapse-{{ $specs->id }}"
                                                    aria-expanded="true"
                                                    aria-controls="collapse-{{ $specs->id }}">{{ $specs->specification->name }}<i
                                                        class="fa fa-plus"></i></button>
                                            </h5>
                                        </div>
                                        <div id="collapse-{{ $specs->id }}"
                                            class="collapse @if($loop->first) show @endif"
                                            aria-labelledby="{{ $specs->id }}" data-parent="#faccordion">
                                            <div class="card-body">
                                                {!! $specs->value !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- end contents for specification tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FEATURES & SPECIFICATIONS -->

        <!-- BUTTONS -->
        <div class="container mb-4">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="{{ asset('storage/'.$vehicle->brochure) }}" target="_blank"
                        class="btn btn-secondary mb-2">DOWNLOAD BROCHURE</a>
                    <a href="#" class="btn btn-primary mb-2">BOOK NOW</a>
                </div>
            </div>
        </div>
        <!-- END BUTTONS -->
    </section>
</main>
@endif
@endsection
