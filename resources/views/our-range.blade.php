@extends('layouts.front')
@section('css_after')
<style>
    .vehicle-category-filter {
        max-width: 420px;
        margin: 0 auto 25px;
    }

    .vehicle-category-filter label {
        display: block;
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: 600;
        color: #222;
    }

    .vehicle-category-select {
        width: 100%;
        height: 52px;
        padding: 10px 18px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: #fff;
        color: #222;
        font-size: 15px;
        cursor: pointer;
    }

    .vehicle-category-select:focus {
        border-color: #092d59;
        box-shadow: 0 0 0 2px rgba(9, 45, 89, 0.1);
        outline: none;
    }


/* All Vehicles Section */

.all-vehicles-section {
    background: #f8f9fb;
}

.all-vehicles-title {
    font-size: 36px;
    font-weight: 700;
    color: #092d59;
    margin-bottom: 15px;
}

.all-vehicles-subtitle {
    font-size: 16px;
    color: #555;
    max-width: 650px;
    margin: 0 auto;
    line-height: 1.7;
}

/* Image Wrapper */

.all-vehicle-image {
    position: relative;
    overflow: hidden;
}

/* Category Tag */

.vehicle-category-tag {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 2;
    background: #092d59;
    color: #fff;
    padding: 8px 15px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.3;
    letter-spacing: 0.4px;
    pointer-events: none;
}

/* Responsive */

@media (max-width: 767px) {
    .all-vehicles-title {
        font-size: 28px;
    }

    .vehicle-category-tag {
        top: 10px;
        left: 10px;
        padding: 6px 12px;
        font-size: 11px;
    }
}


    @media (max-width: 767px) {
        .vehicle-category-filter {
            max-width: 100%;
            margin-bottom: 20px;
        }
    }
</style>
@endsection
@section('content')
    <!--====== About Breadcrumb Part ======-->
    @include('partials.page-hero', [
        'title'       => 'Our Range',
        'subtitle'    => 'Built for adventure and designed for comfort. Explore our range of Australian-made caravans, ready to take you further.',
        'image'       => 'assets/abreco/images/newonce/blog-banner.jpg',
        'breadcrumbs' => [['label' => 'Our Range']],
    ])

    <!--====== About Breadcrumb Part ======-->
    <!-- <section class="abreco-inner-banner ken-burn">
        <div class="about-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <h1>Our Range</h1>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <!-- <section class="abreco-features-area pt-90 pb-90" id="Features">
        <div class="container">
            <div class="row align-items-start">

                <div class="col-12 mb-4">
                    <div class="vehicle-category-filter">
                        <label for="vehicleCategorySelect">
                            Select Vehicle Range
                        </label>
                        <select id="vehicleCategorySelect"
                                class="form-control vehicle-category-select">
                            @foreach ($vehicle_types_data as $type)
                                <option value="v-pills-{{ $type->slug }}"
                                    {{ $loop->first ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="vehicle-category-content">
                        @foreach ($vehicle_types_data as $type)
                            <div class="vehicle-category-pane"
                                id="v-pills-{{ $type->slug }}"
                                style="{{ $loop->first ? '' : 'display:none;' }}">
                                <div class="row justify-content-center">
                                    @php
                                        $vehicles_under_type = App\Vehicle::where(
                                                'vehicle_type_id',
                                                $type->id
                                            )
                                            ->select('slug', 'tagline', 'name', 'image')
                                            ->where('status', 1)
                                            ->orderBy('order', 'ASC')
                                            ->take(8)
                                            ->get();
                                    @endphp
                                    @forelse ($vehicles_under_type as $vehicle_data)
                                        <div class="col-lg-4 col-md-6 mb-4">
                                            <div class="fea-inner">
                                                <div class="img">
                                                    <a href="{{ route('vehicles.show', $vehicle_data->slug) }}">
                                                        <img
                                                            src="{{ asset('storage/' . $vehicle_data->image) }}"
                                                            alt="{{ $vehicle_data->name }}"
                                                            loading="lazy">
                                                    </a>
                                                </div>
                                                <div class="inner-details">
                                                    <h3>
                                                        <a href="{{ route('vehicles.show', $vehicle_data->slug) }}">
                                                            {{ $vehicle_data->name }}
                                                        </a>
                                                    </h3>
                                                    <p>
                                                        {{ \Illuminate\Support\Str::limit(
                                                            strip_tags($vehicle_data->tagline),
                                                            80
                                                        ) }}
                                                    </p>
                                                    <div class="inner-btn flex-wrap mt-3">
                                                        <a href="{{ route('vehicles.show', $vehicle_data->slug) }}"
                                                        class="first-btn">
                                                            View More
                                                        </a>
                                                        <input type="hidden"
                                                            class="vehicle-id"
                                                            value="{{ $vehicle_data->slug }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center py-5">
                                            <p>No vehicles available in this category.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section> -->





<!-- All Vehicles Section -->
<section class="abreco-features-area all-vehicles-section pt-90 pb-90" id="allVehicles">

    <div class="container">

        <!-- Section Heading -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="all-vehicles-title">Explore All Our Caravans</h2>
                <p class="all-vehicles-subtitle">
                    Discover our complete range of Australian-built caravans,
                    designed for comfort, quality and adventure.
                </p>
            </div>
        </div>

        <!-- Vehicles Grid -->
        <div class="row justify-content-center">

            @php
                $allVehicles = \App\Vehicle::where('status', 1)
                    ->with('vehicle_type')
                    ->orderBy('order', 'ASC')
                    ->get();
            @endphp
            @forelse ($allVehicles as $vehicle_data)

                <div class="col-lg-3 col-md-6 mb-4">

                    <div class="fea-inner all-vehicle-card">

                        <!-- Vehicle Image -->
                        <div class="img all-vehicle-image">

                            <!-- Category Tag -->
                            @if ($vehicle_data->vehicle_type)
    <span class="vehicle-category-tag">
        {{ $vehicle_data->vehicle_type->name }}
    </span>
@endif

                            <a href="{{ route('vehicles.show', $vehicle_data->slug) }}">
                                <img
                                    src="{{ asset('storage/' . $vehicle_data->image) }}"
                                    alt="{{ $vehicle_data->name }}"
                                    loading="lazy">
                            </a>

                        </div>

                        <!-- Vehicle Details -->
                        <div class="inner-details">

                            <h3>
                                <a href="{{ route('vehicles.show', $vehicle_data->slug) }}">
                                    {{ $vehicle_data->name }}
                                </a>
                            </h3>

                            <p>
                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($vehicle_data->title),
                                    80
                                ) }}
                            </p>

                            <div class="inner-btn flex-wrap mt-3">

                                <a href="{{ route('vehicles.show', $vehicle_data->slug) }}"
                                   class="first-btn">
                                    View More
                                </a>

                                <input
                                    type="hidden"
                                    class="vehicle-id"
                                    value="{{ $vehicle_data->slug }}">

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center py-5">
                    <p>No vehicles available at the moment.</p>
                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection

@section('js_after')
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const categorySelect = document.getElementById('vehicleCategorySelect');

            const categoryPanes = document.querySelectorAll('.vehicle-category-pane');

            if (!categorySelect) return;

            function showVehicleCategory(selectedId) {

                categoryPanes.forEach(function (pane) {

                    if (pane.id === selectedId) {
                        pane.style.display = 'block';
                    } else {
                        pane.style.display = 'none';
                    }

                });

            }

            categorySelect.addEventListener('change', function () {
                showVehicleCategory(this.value);
            });

            // Show initially selected category
            showVehicleCategory(categorySelect.value);

        });

    </script>
@endsection
