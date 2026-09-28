@extends('layouts.app')
@section('css_after')

@endsection

@section('content')
    <!-- BANNER -->
    <section class="hero set-bg min-height-450 overlay"
        data-setbg="{{ asset('assets/images/background/arena.png') }}">
        <div class="container">
            <div class="row">
                <h1 class="text-center text-white col-md-12">Policies</h1>
                <div class="text-center breadcrumbs col-md-12">
                    <p class="text-white"><a href="{{ route('home') }}">Home</a> <i class="mx-2 fa fa-angle-right"
                            aria-hidden="true"></i> <span>Policies</span></p>
                </div>
            </div>
        </div>
    </section>
    <!-- END BANNER -->

    <main id="content">
        <section class="pb-5 bg-black">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Policy-for-Determination-of-Materiality.pdf') }}"
                            target="_blank">
                            Policy for Determination of Materiality
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Policy-for-Evaluation-of-Performance-of-Board-of-Directors.pdf') }}"
                            target="_blank">
                            Policy for Evaluation of Performance of Board of Directors
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Policy-for-Familiarisation-Programme-for-Independent-Directors.pdf') }}"
                            target="_blank">
                            Policy for Familiarisation Programme for Independent Directors
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Policy-for-Preservation-of-Documents.pdf') }}"
                            target="_blank">
                            Policy for Preservation of Documents
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Policy-on-Material-Subsidiaries.pdf') }}"
                            target="_blank">
                           Policy on Material Subsidiaries
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Policy-on-Related-Party-Transactions.pdf') }}"
                            target="_blank">
                            Policy on Related Party Transactions
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Policy-to-promote-Diversity-of-Board-of-Directors.pdf') }}"
                            target="_blank">
                            Policy to promote Diversity of Board of Directors
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Risk-Management-Policy.pdf') }}"
                            target="_blank">
                            Risk Management Policy
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Succession-Policy.pdf') }}"
                            target="_blank">
                            Succession Policy
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Whistle-Blower-Policy.pdf') }}"
                            target="_blank">
                            Whistle Blower Policy
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Anti-Sexual-Harrassment-Policy.pdf') }}"
                            target="_blank">
                            Anti Sexual Harrassment Policy
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Archival-Policy.pdf') }}"
                            target="_blank">
                            Archival Policy
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Code-of-Conduct-for-Board-of-Directors-and-SMPs.pdf') }}"
                            target="_blank">
                            Code of Conduct for Board of Directors and SMPs
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Code-of-practices-and-procedures-for-fair-disclosure-of-UPSI.pdf') }}"
                            target="_blank">
                            Code of practices and procedures for fair disclosure of UPSI
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Corporate-Social-Responsibility-Policy.pdf') }}"
                            target="_blank">
                            Corporate Social Responsibility Policy
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Dividend-Distribution-Policy.pdf') }}"
                            target="_blank">
                            Dividend Distribution Policy
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3  py-1 mb-3 d-block"
                            href="{{ asset('documents/Insider-Trading-Policy.pdf') }}"
                            target="_blank">
                            Insider Trading Policy
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="px-3 py-1 mb-3 d-block"
                            href="{{ asset('documents/Nomination-and-Remuneration-Policy.pdf') }}"
                            target="_blank">
                            Nomination and Remuneration Policy
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js_after')

@endsection
