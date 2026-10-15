@extends('layouts.front')
@section('css_after')
<style>
    .everest-reviews-grid {margin-top: 20px;}
    .everest-review-item {width: 100%;}
    .everest-review-card {position: relative;background: #f8f8f8;border: 1px solid #eeeeee;border-radius: 7px;padding: 20px 18px 35px;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.10);min-height: 180px;}
    .everest-review-header {display: flex;align-items: center;gap: 12px;margin-bottom: 10px;}
    .review-quote {font-family: Georgia, serif;font-size: 48px;font-weight: bold;color: #bdbdbd;line-height: 25px;}
    .review-stars {display: flex;gap: 3px;}
    .review-stars i {font-size: 16px;color: #d1d1d1;}
    .review-stars i.active {color: #ffca00;}
    .everest-review-text {font-size: 15px;font-style: italic;line-height: 1.55;color: #222;overflow-wrap: anywhere;display: -webkit-box;-webkit-line-clamp: 5;-webkit-box-orient: vertical;overflow: hidden;}
    .everest-review-brand {position: absolute;right: 12px;bottom: 10px;font-size: 10px;font-weight: 800;letter-spacing: 1px;color: #e36d30;}
    .everest-review-author {display: flex;align-items: center;gap: 12px;padding-top: 12px;}
    .everest-review-author img {width: 42px;height: 42px;border-radius: 50%;object-fit: cover;flex-shrink: 0;}
    .everest-review-author-info h5 {font-size: 14px;font-weight: 700;color: #111;margin: 0 0 4px;}
    .everest-review-author-info span,
    .everest-review-author-info small {display: block;font-size: 12px;color: #555;line-height: 1.5;}
    .everest-review-video {margin-top: 15px;}
    .everest-review-video iframe {width: 100%;height: 190px;border: 0;border-radius: 6px;}
    section.videoo.vehicle-reviews {background: #f5f6fa;padding: 80px 0 60px;}
    .vehicle-reviews .tab-content {max-width: 70%;padding: 20px 0px;margin: 0px auto;}
    @media (max-width: 767px) {
        .everest-review-card {min-height: auto;}
        .everest-review-text {font-size: 14px;}
    }
</style>
@endsection
@section('content')
<!--====== About Breadcrumb Part ======-->
@include('partials.page-hero', [
'title' => 'Google Reviews',
'subtitle' => 'Discover what our customers have to say about their Everest Caravans experience.',
'image' => 'assets/abreco/images/newonce/video-banner.jpg',
'breadcrumbs' => [['label' => 'Google Reviews']],
])
<section class="abreco-features-area pt-90 pb-90" id="Features">
    <div class="container">
        <div class="row align-items-start google-reviews-grid">
            @forelse($testimonials as $testimonial)
                <div class="col-lg-4 col-md-6 col-12 mb-5">

                    <div class="everest-review-item">

                        <div class="everest-review-card">

                            <div class="everest-review-header">
                                <span class="review-quote">“</span>

                                <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fa fa-star {{ $i <= (int) $testimonial->rating ? 'active' : '' }}"></i>
                                    @endfor
                                </div>
                            </div>

                            @if($testimonial->message)
                                <div class="everest-review-text">
                                    {!! $testimonial->message !!}
                                </div>
                            @endif

                            @if($testimonial->url)
                                <div class="everest-review-video">
                                    <iframe src="{{ $testimonial->url }}" title="Review by {{ $testimonial->name }}"
                                        loading="lazy" allowfullscreen>
                                    </iframe>
                                </div>
                            @endif

                        </div>

                        <div class="everest-review-author">

                            <img src="{{ $testimonial->photo
                                    ? asset('storage/' . $testimonial->photo)
                                    : asset('assets/images/avatar.png') }}" alt="{{ $testimonial->name }}"
                                loading="lazy">

                            <div class="everest-review-author-info">

                                <h5>{{ $testimonial->name }}</h5>

                                @if($testimonial->created_at)
                                    <small>
                                        {{ $testimonial->created_at->format('F d, Y') }}
                                    </small>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p>No reviews available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@section('js_after')
<script></script>
@endsection