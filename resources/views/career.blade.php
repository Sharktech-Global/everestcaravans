@extends('layouts.front')
<style>
 .small-span{
     font-size: 12px;
 }
</style>

@section('content')
    <!--====== contact Breadcrumb Part ======-->
    <section class="abreco-inner-banner career-bg-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner bread-inner-contact">
                        <div class="baner-bg-head2">
                            <img src="{{ asset('assets/abreco/images/shapes/banner-head.webp') }}" alt="">

                        </div>
                        <h1>Join Our Growing Team - We Are Hiring!</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Joining Top Part ======-->
    <section class="joining-part section pt-100 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="join-text">
                        <h2>{{ @$page->title }}</h2>
                        <p>{!! @$page->content !!}</p>
                        <div class="primary-btn-main">
                            <a href="#career-form-section" class=" new-btn-style">
                                <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21" height="14"
                                    viewBox="0 0 21 14" fill="none">
                                    <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <img src="{{asset('assets/abreco/images/shapes/right-white.webp')}}" class="d-none white" alt="">
                                Join Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="join-img">
                        <img src="{{ asset('storage/' . @$page->banner_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== New Openingts Part ======-->
    <section class="new-open section pb-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="open-head">
                        <h2>New Openings in our team</h2>
                        <p>Abreco Group is a multi-faceted business conglomerate headquartered in the UAE with operations in
                            over twenty countries and a workforce of over 3,000 people. Abreco Group’s diverse global teams
                            bring in deep industry and functional expertise, successfully operating</p>
                    </div>
                    <div class="job-description">
                        <div class="row" id="career-content">
                            @foreach ($careers as $data)
                                <div class="col-lg-4 col-md-6  box">
                                    <div class="career-box">
                                        <h3>{{ @$data->title }}</h3>
                                        <p>{!! @$data->description !!} </p>
                                        <div
                                            class="bottom-career d-flex align-items-center justify-content-between flex-wrap ">
                                            {{--  <div class="department-area">
                                                <span class="position-re">Sales Team</span>
                                            </div>  --}}
                                            <div class="primary-btn-main2">
                                                <a href="#career-form-section" class="new-btn-style20"
                                                    onclick="selectCareer('{{ $data->id }}')">Apply Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Contact PART START ======-->
    <section class="contact-section section" id="career-form-section">
        <div class="container">
            <div class="row">
                
            <div class="col-lg-4 order-1-991">
                    <div class="contact-head">
                        <h2>Enquire now</h2>
                        <h5>Time to gear up
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="21" viewBox="0 0 28 21"
                                fill="none">
                                <path d="M15.4389 0H17.609L12.606 21H10.3047L15.4389 0Z" fill="white" />
                                <path d="M25.7436 0H27.9137L22.9107 21H20.6094L25.7436 0Z" fill="white" />
                                <path d="M5.13422 0H7.30435L2.30132 21H0L5.13422 0Z" fill="white" />
                            </svg>
                        </h5>
                        <p>Now let’s start this new venture together and experience the seamless services and rides of
                            Abreco with all its premium quality. Commence this journey to find your smooth ride.</p>
                    </div>
                </div>
                <div class="col-lg-8 order-2-991">
                    <div class="contact-form">
                        <form action="{{ route('careers.store') }}" method="POST"
                            id="my-form-request-id"enctype="multipart/form-data">
                            @csrf
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name *" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <select name="career_type" id="career_type" class="form-control" required>
                                            <option value="">Select Career</option>
                                            @foreach ($careers as $data)
                                                <option
                                                    value="{{ $data->id }}"{{ old('career_type') == $data->id ? 'selected' : '' }}>
                                                    {{ $data->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="tel" name="phone" placeholder="Phone Number *" class="form-control"
                                        value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email Id *" class="form-control"
                                           value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Type your Message....">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 new-file-style">
                                        <label class="text-white">Upload CV * <span  class="small-span">(PDF file with  maximum size 2mb)</span></label>
                                    <div class="form-group">
                                        <input type="file" name="cv" id="file" class="text-white" required>
                                        @if (old('cv'))
                                            <input type="hidden" name="cv" value="{{ old('cv') }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display(['data-theme' => 'light', 'required' => 'required']) !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                                <label
                                                    style="color:red">{{ $errors->first('g-recaptcha-response') }}</label>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <!-- <input type="submit" name="submit" class="form-control submit-btn" value="Submit Form" required> -->
                                        <button type="submit" name="submit"
                                            class="form-control submit-btn new-btn-style">
                                            <svg class="color" xmlns="http://www.w3.org/2000/svg" width="21"
                                                height="14" viewBox="0 0 21 14" fill="none">
                                                <path d="M1 7L20 7M20 7L13.6852 1M20 7L13.6852 13" stroke="#9D166C"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <img src="{{asset('assets/abreco/images/shapes/right-white.webp')}}" class="d-none white"
                                                alt="">
                                            Submit Form
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_after')
    <script>
        function selectCareer(careerId) {
            var $careerOption = $("#career_type option[value='" + careerId + "']");
            if ($careerOption.length) {
                $careerOption.prop('selected', true);
            }
        }
    </script>
@endsection
