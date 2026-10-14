@extends('layouts.front')

@section('content')
    <!--====== Videos Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Videos',
        'subtitle'    => 'See Everest Caravans in action. Explore our videos showcasing innovative designs, premium features and unforgettable adventures.',
        'image'       => 'assets/abreco/images/newonce/blog-banner.jpg',
        'breadcrumbs' => [['label' => 'Videos']],
    ])

    <!--====== VIDEOS START ======-->
    {{-- Both channels behind one switcher. Each tab's panel is the matching
         component, which can also be dropped on any other page on its own:
         @include('partials.ev-videos-everest') / ...-gorv --}}
    @include('partials.ev-videos-tabs')
@endsection
