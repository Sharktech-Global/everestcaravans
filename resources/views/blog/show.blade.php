@extends('layouts.front')
@section('content')
    <!--====== Blog Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Blogs',
        'subtitle'    => 'Stories from the road, expert tips and the latest from Everest Caravans. Find inspiration for wherever your next journey takes you.',
        'image'       => 'assets/abreco/images/newonce/blog-banner.jpg',
        'breadcrumbs' => [['label' => 'Blogs']],
    ])

    <!--====== BLOG LISTING START ======-->
    {{-- Everest Caravans — Blog listing, three cards per row
         Shares public/css/blog.css with the Latest Updates listing.
         Fonts are the site pair (Space Grotesk + Poppins); both already load
         above, so this section requests none. --}}
    @php $blCss = 'css/blog.css'; @endphp
    @if (file_exists(public_path($blCss)))
        <link rel="stylesheet" href="{{ asset($blCss) }}?v={{ filemtime(public_path($blCss)) }}">
    @else
        <!-- EVEREST: public/{{ $blCss }} not found -->
    @endif

    @php
        // ===================== EDIT HERE =====================
        $bl = [
            'eyebrow' => 'From the blog',
            'title'   => 'Our latest blogs',
            'lead'    => 'We have jotted together our stories and knowledge to keep you updated. Give it a quick drift.',

            // Mark in the top-right corner of every card photo. null hides it.
            'mark'    => @$settings->logo ? 'storage/' . $settings->logo : null,
        ];
        // =====================================================

        // Newest first
        $blPosts = collect($blogs ?? [])->sortByDesc(fn ($b) => $b->date_display ?: $b->created_at)->values();

        // Uploaded logo names carry spaces and brackets, so encode each segment
        $blMark = $bl['mark'] && is_file(public_path($bl['mark']))
            ? asset(implode('/', array_map('rawurlencode', explode('/', $bl['mark']))))
            : null;
    @endphp

    <section class="ev-blog" aria-labelledby="evBlogTitle">
        <div class="ev-blog__inner">

            <header class="ev-blog__head">
                <p class="ev-blog__eyebrow">{{ $bl['eyebrow'] }}</p>
                <h2 class="ev-blog__title" id="evBlogTitle">{{ $bl['title'] }}</h2>
                <p class="ev-blog__lead">{{ $bl['lead'] }}</p>
            </header>

            <div class="ev-blog__grid">
                @forelse ($blPosts as $post)
                    @php
                        $blUrl = route('blog.details', $post->slug);

                        // Uploaded names contain spaces, so encode each segment
                        $blPath = 'storage/' . $post->feature_image;
                        $blImg  = $post->feature_image && is_file(public_path($blPath))
                                    ? asset(implode('/', array_map('rawurlencode', explode('/', $blPath))))
                                    : null;

                        // details is rich text. Tags become spaces (not nothing) so
                        // "</h2><p>" can't run two words together, then entities are
                        // decoded and the whitespace — &nbsp; included — collapsed.
                        $blText = strip_tags(preg_replace('/<[^>]*>/', ' ', (string) $post->details));
                        $blText = html_entity_decode($blText, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $blText = trim(preg_replace('/[\s\x{00A0}]+/u', ' ', $blText));
                        // Tag-to-space can leave "Motors ," — pull the punctuation back
                        $blText = \Illuminate\Support\Str::limit(preg_replace('/ +([,.;:!?%)\]])/u', '$1', $blText), 120);

                        $blDate = $post->date_display ?: $post->created_at;
                        $blDate = $blDate ? \Illuminate\Support\Carbon::parse($blDate) : null;
                    @endphp

                    <article class="ev-blog__card">
                        {{-- Not a link itself: the title's stretched link covers the whole card --}}
                        <div class="ev-blog__thumb{{ $blImg ? '' : ' ev-blog__thumb--empty' }}">
                            @if ($blImg)
                                <img src="{{ $blImg }}" alt="" loading="lazy" decoding="async">
                            @else
                                {{-- No photo yet: the van mark keeps the card from looking broken --}}
                                <svg viewBox="0 0 24 24"><path d="M3 16V7a1 1 0 0 1 1-1h12l4 5v5"/><path d="M3 16h18"/><circle cx="7.5" cy="18" r="2"/><circle cx="16.5" cy="18" r="2"/></svg>
                            @endif

                            @if ($blMark)
                                {{-- Decorative, and click-through so it cannot
                                     block the card's stretched link --}}
                                <span class="ev-blog__mark" aria-hidden="true">
                                    <img src="{{ $blMark }}" alt="" loading="lazy" decoding="async">
                                </span>
                            @endif

                            @if ($blDate)
                                <span class="ev-blog__date">
                                    <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 11h18"/></svg>
                                    {{ $blDate->format('M d, Y') }}
                                </span>
                            @endif
                        </div>

                        <div class="ev-blog__body">
                            <h3 class="ev-blog__card-title">
                                <a href="{{ $blUrl }}">{{ $post->title }}</a>
                            </h3>

                            @if ($blText)
                                <p class="ev-blog__excerpt">{{ $blText }}</p>
                            @endif

                            <span class="ev-blog__more" aria-hidden="true">
                                Read More
                                <svg viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                            </span>
                        </div>
                    </article>
                @empty
                    <div class="ev-blog__empty">
                        <h3>Nothing posted just yet</h3>
                        <p>Our next blog is on its way — check back soon.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
@endsection
