@extends('layouts.app')

@section('content')

<main id="content" class="comparison-products">

    {{-- comparison vehicles --}}
    <section class="bg-black">
        <div class="container pb-5 hero set-bg">
            <div class="row pos-rel">
                <div class="col-md-4 xs-none banner">
                    <h1>COMPARISON <br>RESULTS</h1>
                </div>
                <div class="col-md-4">
                    <div class="comparison py-5">
                        <div class="compare-car text-center" data-toggle="modal" data-target="#compare-models">
                            <img src="@if($vehicle->image){{ asset('storage/'.@$vehicle->image) }}@else{{ asset('assets/images/compare/selected-car.png') }}@endif"  alt="Abreco">
                            <h4>@if(@$vehicle->name) {{@$vehicle->name}} @else Model 1 @endif</h4>
                            {{-- <p>Change Model</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pos-rel">
                    <div class="vs text-center">
                        <p>VS</p>
                    </div>
                    <div class="comparison py-5">
                        <div class="compare-car text-center" data-toggle="modal" data-target="#compare-models">
                            <img src="@if(@$vehicle1->image){{ asset('storage/'.@$vehicle1->image) }}@else{{ asset('assets/images/compare/selected-car.png') }}@endif"  alt="Abreco">
                            <h4>@if(@$vehicle1->name) {{@$vehicle1->name}} @else Model 2 @endif</h4>
                            {{-- <p>Change Model</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pos-rel">
                    <p class="hero__text text-white pt-0 text-left">
                        <a href="{{route('comparison.index')}}" class="primary-btn" id='reset-compare'>Compare more</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- end comparison vehicles --}}

    {{-- comparison table --}}
    <section class="bg-black comparison-table">
        <div class="container">
            @foreach ($category_type as $data)
            <h2 class="text-white mb-2">{{@$data->name}}</h2>
                @if($data->categories()->where('status',1)->count())
                    @foreach ($data->categories()->where('status',1)->orderBy('name')->get() as $category )
                    <table class="table table-bordered table-striped table-responsive-stack" id="">
                        <thead class="thead-dark">
                            <tr>

                                <th>{{@$category->name}}</th>
                                <th>{{@$variant->name}}</th>
                                <th>{{@$variant1->name}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->subCategories()->where('status',1)->orderBy('name')->get() as $subcat )
                                {{-- {{-- @foreach ($vehicle_details as $vehicle_detail)
                                @foreach ($vehicle_details1 as $vehicle_detail1) --}}
                                    @php
                                        $details = $vehicle_details->where('category_type_id',$data->id)->where('category_id',$category->id)->where('sub_category_id',$subcat->id)->where('vehicle_variant_id', $variant->id)->first();
                                        $details1 = $vehicle_details1->where('category_type_id',$data->id)->where('category_id',$category->id)->where('sub_category_id',$subcat->id)->where('vehicle_variant_id', $variant1->id)->first();

                                    @endphp
                                <tr>
                                    <td>{{@$subcat->name}}</td>
                                    @if(@$details->is_boolean == 1)
                                        <td>
                                            @if(@$details->status == 0)
                                                <i class="fa fa-check text-white" aria-hidden="true"></i>
                                            @elseif(@$details->status == 1)
                                                <i class="fa fa-times text-white" aria-hidden="true"></i>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                            <p class="text-white">@if(@$details->details) {{$details->details}} @else -- @endif</p>
                                        </td>
                                    @endif
                                    {{-- second variant --}}
                                    @if(@$details1->is_boolean == 1)
                                        <td>
                                            @if(@$details1->status == 0)
                                                <i class="fa fa-check text-white" aria-hidden="true"></i>
                                            @elseif(@$details1->status == 1)
                                                <i class="fa fa-times text-white" aria-hidden="true"></i>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                            <p class="text-white">@if(@$details1->details) {{$details1->details}} @else -- @endif</p>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach
                @endif
            @endforeach
        </div>
    </section>
    {{-- end comparison table --}}

    {{-- modal popup --}}
    {{-- <div id="compare-models" class="modal fade compare-vehicle-model" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center footer__widget pt-0">
                    <h5>SELECT A VEHICLE</h5>
                    <div class="row">
                        <div class="col-6">
                            <form action="" class="call__form js-validation-popup" method="post">
                                <div class="form-group col-lg-12 pb-1">
                                    <label class="text-left w-100">Make</label>
                                    <Select class="pl-0">
                                        <option>Make 1</option>
                                        <option>Make 2</option>
                                        <option>Make 3</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-12 pb-1">
                                    <label class="text-left w-100">Select vehicle body type</label>
                                    <Select class="pl-0">
                                        <option>vehicle body type 1</option>
                                        <option>vehicle body type 2</option>
                                        <option>vehicle body type 3</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-12 pb-1">
                                    <label class="text-left w-100">Model Variant</label>
                                    <Select class="pl-0">
                                        <option>Model Variant 1</option>
                                        <option>Model Variant 2</option>
                                        <option>Model Variant 3</option>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="reset" class="site-btn bg-white text-dark border">CANCEL</button>
                                    <button type="submit" class="site-btn">ADD MODEL</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('assets/images/compare/selected-car.png') }}"  alt="Abreco">
                            <h4>Lexus ES 300h Exquisite</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- end modal popup --}}

</main>
@endsection

@section('js_after')
<script>
    $(document).ready(function() {
        $('#reset-compare').on("click", function(){
                $.ajax({
                type:"POST",
                url: '{{ route("comparison.foreget") }}',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    number : 3,
                },
                success:function(response){

                }
            });
        });
    });

</script>
@endsection

@section('css_after')
<style>
    .comparison {

    }
    .compare-car {
        cursor: pointer;
    }
    .compare-car img {
        max-width: 65%;
    }
    .compare-car.text-center h4 {
        color: #fff;
    }
    .compare-car.text-center p {
        text-decoration: underline;
    }
    .compare-vehicle-model label {
        font-weight: 600;
    }
    .compare-vehicle-model .modal-header {
        border-bottom: 0px;
    }
    .compare-vehicle-model .modal-dialog select {
        border-bottom: 1px solid #eee;
    }
    .vs {
        position: absolute;
        top: 50%;
        left: 0%;
        transform: translate(-50%, -50%);
        margin: 0;
        height: 350px;
    }
    .vs p {
        color: #7c7c7c !important;
        font-size: 20px;
        font-weight: 100;
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .vs p:before {
        content: '';
        height: 80px;
        width: 1px;
        position: absolute;
        top: 35px;
        left: 12px;
        bottom: unset;
        background: #7c7c7c;
    }
    .vs p:after {
        content: '';
        height: 80px;
        width: 1px;
        position: absolute;
        top: unset;
        left: 12px;
        bottom: 35px;
        background: #7c7c7c;
    }


    .comparison-table .table .thead-dark th {
        border-color: #d7dbe0;
        border-bottom: 0;
    }
    .comparison-table .table .thead-dark th {
        width: 33.3333%
    }
    .comparison-table .table .thead-dark td {
        width: 33.3333%
    }
    .comparison-products .col-md-4.xs-none h1 {
        color: #fff;
        position: absolute;
        top: 50%;
        left: 0;
        transform: translate(0%, -50%);
    }
    @media (max-width: 767px) {
        .comparison-table h2.text-white {
            font-size: 22px;
            margin-bottom: 10px;
        }
        .vs:before, .vs:after {
            height: 0;
        }
        .vs {
            top: 50%;
        }
        .compare-car.text-center p {
            font-size: 12px;
        }
        .compare-car.text-center h4 {
            font-size: 16px;
        }
        .comparison-products .col-md-4 {
            width: 50%;
            float: left;
        }
        .comparison-products .col-md-4.xs-none {
            width: 100%;
        }
    }

    @media (min-width: 576px) {
        .compare-vehicle-model .modal-dialog {
            max-width: 55%;
        }
    }
</style>
@endsection
