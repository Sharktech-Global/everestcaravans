@extends('layouts.front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection
@section('content')
    @include('partials.page-hero', [
        'title'       => 'Thank You',
        'subtitle'    => 'Thanks for reaching out! We have recieved your enquiry, Our team will contact you as soon as possible.',
        'image'       => 'assets/abreco/images/29.jpg',
        'breadcrumbs' => [['label' => 'Thank You']],
    ])
@endsection

@section('js_after')
@endsection