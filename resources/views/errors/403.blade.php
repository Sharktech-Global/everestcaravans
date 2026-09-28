@section('content')
<!-- BANNER -->
<section class="hero set-bg min-height-160 bg-c3c3c3 pt-150">
    <div class="container">
        <div class="row">

        </div>
    </div>
</section>
<!-- END BANNER -->

<main id="content">
    <section class="bg-black">
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-md-12 py-5">
                    <h1 class="text-white text-center">403</h1>
                    <p class="text-white text-center">
                        @section('message', __($exception->getMessage() ?: 'Forbidden'))
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
