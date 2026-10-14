@extends('layouts.app')

@section('content')

<main id="content">
    <section class="bg-black">
        <div class="container pb-5 hero set-bg">
            <div class="row pos-rel">
                <div class="banner w-100 text-center text-white">
                    <h1>COMPARISON</h1>
                </div>
                <div class="vs text-center">
                    <p>VS</p>
                </div>
                <div class="col-md-6">
                    <div class="comparison py-5">
                        <div class="compare-car text-center" data-toggle="modal" data-target="#compare-models">
                            <img src="@if(@$data->image) {{ asset('storage/'.@$data->image) }} @else {{ asset('assets/images/compare/car-placeholder-1.png') }} @endif"  alt="Everest">
                            <h4>@if(@$data->name) {{@$data->name}} @else Select Model 1 @endif</h4>
                            <p>@if(@$data->name) Edit Model @else Add a Model @endif</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="comparison py-5">
                        <div class="compare-car text-center" data-toggle="modal" data-target="#compare-models1">
                            <img src="@if(@$data1->image) {{ asset('storage/'.$data1->image) }} @else {{ asset('assets/images/compare/car-placeholder-1.png') }} @endif"  alt="Everest">
                            <h4>@if(@$data1->name) {{$data1->name}} @else Select Model 2 @endif</h4>
                            <p>@if(@$data1->name) Edit Model @else Add a Model @endif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="hero__text text-white pt-5">
                        @php
                            if(@$data->id){
                                $value = @$data->id;
                                $value_variant = @$value_variant; }
                            if(@$data1->id){
                                 $value1 = @$data1->id;
                                 $value_variant1 = @$value_variant1;
                                }
                        @endphp
                        @if(@$value !== null )
                            @if(@$value_variant !== null )
                                @if(@$value1 !== null)
                                    @if(@$value_variant1 !== null )
                                    <a href="{{route('comparison.compare',[$value,$value_variant,$value1,$value_variant1])}}" class="primary-btn">COMPARE MODELS</a>
                                    @else
                                    <a class="primary-btn">Please select second model variant</a>
                                    @endif
                                @else
                                <a class="primary-btn">Please select second model</a>
                                @endif
                            @else
                            <a class="primary-btn">Please select first model variant</a>
                            @endif
                        @else
                        <a class="primary-btn">Please select first model</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div id="compare-models" class="modal fade compare-vehicle-model" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center footer__widget pt-0">
                    <h5>SELECT A VEHICLE</h5>
                    <div class="row">
                        <div class="col-6">
                            <form action="" class="call__form js-validation-popup" id='comparison' method="post">
                                <div class="form-group col-lg-12 pb-1">
                                    <label class="text-left w-100">Vehicle</label>
                                    <Select class="pl-0" name='comparison-select' id='comparison-select' required>
                                        <option value=''>Select</option>
                                        @foreach ($vehicle  as $value )
                                        <option @if(@$data->id == $value->id ) selected @endif value='{{@$value->id}}'>{{@$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group col-lg-12 pb-1">
                                    <label class="text-left w-100">Select vehicle body type</label>
                                    <Select class="pl-0">
                                        <option>vehicle body type 1</option>
                                        <option>vehicle body type 2</option>
                                        <option>vehicle body type 3</option>
                                    </select>
                                </div> --}}
                                <div class="form-group col-lg-12 pb-1">
                                    <label class="text-left w-100">Model Variant</label>
                                    <Select class="pl-0" id='comparison-variant' required>
                                        @if (@$value_variant && @$variant_name->name)
                                        <option value='{{@$value_variant}}'>{{@$variant_name->name}}</option>
                                        @endif
                                        {{-- @foreach ($vehicle->varients()->get()  as $value )
                                        <option value='{{@$value->id}}'>{{@$value->name}}</option>
                                        @endforeach --}}
                                        {{-- <option>Model Variant 1</option> --}}

                                    </select>
                                    <p class ='text-left' id='error_message'> </p>
                                </div>
                                <div class="text-center">
                                    <button type="reset" id='reset' class="site-btn bg-white text-dark border">REMOVE</button>
                                    <button type="button" id='action' class="site-btn">ADD MODEL</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6" >
                            <img alt="Everest" id="comparison-image" src="@if(@$data->image) {{ asset('storage/'.@$data->image) }} @else {{ asset('assets/images/compare/selected-car.png') }} @endif" >
                            <h4 id='comparison-vehicle-name'>@if(@$data->name){{@$data->name}}@endif</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal2 --}}
    <div id="compare-models1" class="modal fade compare-vehicle-model" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center footer__widget pt-0">
                    <h5>SELECT A VEHICLE</h5>
                    <div class="row">
                        <div class="col-6">
                            <form action="" class="call__form js-validation-popup" id='comparison1' method="post">
                                <div class="form-group col-lg-12 pb-1">
                                    <label class="text-left w-100">Vehicle</label>
                                    <Select class="pl-0" name='comparison-select' id='comparison-select1' required>
                                        <option value=''>Select</option>
                                        @foreach ($vehicle  as $value )
                                        <option @if(@$data1->id == $value->id ) selected @endif  value='{{@$value->id}}'>{{@$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-12 pb-1">
                                    <label class="text-left w-100">Model Variant</label>
                                    <Select class="pl-0" id='comparison-variant1' required>
                                        @if (@$value_variant1 && @$variant_name1->name)
                                        <option value='{{@$value_variant1}}'>{{@$variant_name1->name}}</option>
                                        @endif
                                    </select>
                                <p class ='text-left' id='error_message1'> </p>
                                </div>
                                <div class="text-center">
                                    <button type="reset" id='reset1' class="site-btn bg-white text-dark border">REMOVE</button>
                                    <button type="button" id='action1' class="site-btn">ADD MODEL</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6" >
                            <img alt="Everest" id="comparison-image1" src="@if(@$data1->image) {{ asset('storage/'.$data1->image) }} @else {{ asset('assets/images/compare/selected-car.png') }} @endif" >
                            <h4 id='comparison-vehicle-name1'>@if(@$data1->name){{$data1->name}}@endif</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>
@endsection
@section('js_after')
<script>
    $(document).ready(function() {
        if ($('#comparison-select').val() == ''){
            $('#reset').addClass("d-none");
        }
        if ($('#comparison-select1').val() == ''){
            $('#reset1').addClass("d-none");
        }

        $('#reset').on("click", function(){
            var image_url = "{{ asset('') }}";
            $('#comparison-image').attr('src',image_url+'/assets/images/compare/selected-car.png')
            $('#comparison-select').html('<option value="">Select</option>')
            $('#comparison-vehicle-name').html('')


            $.ajax({
                type:"POST",
                url: '{{ route("comparison.foreget") }}',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    number : 1,
                },
                success:function(response){
                    if(response){
                        setTimeout(location.reload.bind(location), 500);
                        // location.reload();
                    }
                }
            });

        });
        $('#comparison-select').change(function(e) {
        var selected = $('#comparison-select').val();
        var $options = $('<option>');
        var image_url = "{{ asset('storage') }}";
        $("#comparison-variant").html('');
        $.ajax({
                url: '{{ route("comparison.index") }}',
                type: "get",
                dataType: 'json',
                data: {
                    selected: selected,
                },
                _token: '{{csrf_token()}}',
                success: function(response) {
                    // console.log(response.variants)
                    if(response.variants){
                        $('#comparison-variant').html('<option value="">Select Variant</option>');
                        $.each(response.variants,function(key,value){
                            $("#comparison-variant").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $('#reset').removeClass("d-none");
                    }
                    if(response.image){
                        // console.log(response.image.image)
                        $('#comparison-image').attr('src',image_url+'/'+response.image.image)
                        $('#comparison-vehicle-name').text(response.image.name)
                    }
                }
            });
        });
    });

    $('#action').click(function(){
    var vehicle_id =$('#comparison-select').val();
    var variant_id =$('#comparison-variant').val();
    // console.log(variant_id)
        if(variant_id !== null){
            $.ajax({
                type:"POST",
                url: '{{ route("comparison.store") }}',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    vehicle_id : vehicle_id,
                    variant_id :variant_id,
                    number : 1,
                },
                success:function(response){
                    if(response){
                        // console.log('reload')
                        location.reload();
                    }
                }
            });
        }else{
            $('#error_message').append('<span style="color:red"> This field is required </span>');
            $('#error_message').delay(3000).fadeOut('slow');
            // $('#error_message').text() = '';
        }
    });


    // modal2
    $(document).ready(function() {
        $('#reset1').on("click", function(){
            var image_url = "{{ asset('') }}";
            $('#comparison-image1').attr('src',image_url+'/assets/images/compare/selected-car.png')
            $('#comparison-select1').html('<option value="">Select </option>')
            $('#comparison-vehicle-name1').html('')

            $.ajax({
                type:"POST",
                url: '{{ route("comparison.foreget") }}',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    number : 2,
                },
                success:function(response){
                    if(response){
                        // console.log('reload')
                        // location.reload();
                        setTimeout(location.reload.bind(location), 500);
                    }
                }
            });
        });
        $('#comparison-select1').change(function(e) {
        var selected = $('#comparison-select1').val();
        var $options = $('<option>');
        var image_url = "{{ asset('storage') }}";
        $("#comparison-variant1").html('');
        $.ajax({
                url: '{{ route("comparison.index") }}',
                type: "get",
                dataType: 'json',
                data: {
                    selected: selected,
                },
                _token: '{{csrf_token()}}',
                success: function(response) {
                    // console.log(response.variants)
                    if(response.variants){
                        $('#comparison-variant1').html('<option value="">Select Variant</option>');
                        $.each(response.variants,function(key,value){
                            $("#comparison-variant1").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $('#reset1').removeClass("d-none");
                    }
                    if(response.image){
                        // console.log(response.image.image)
                        $('#comparison-image1').attr('src',image_url+'/'+response.image.image)
                        $('#comparison-vehicle-name1').text(response.image.name)
                    }
                }
            });
        });
    });

    $('#action1').click(function(){
    var vehicle_id =$('#comparison-select1').val();
    var variant_id =$('#comparison-variant1').val();
    // console.log(variant_id)
        if(variant_id !== null){
            $.ajax({
                type:"POST",
                url: '{{ route("comparison.store") }}',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    vehicle_id : vehicle_id,
                    variant_id :variant_id,
                    number : 2,
                },
                success:function(response){
                    if(response){
                        // console.log('reload')
                        location.reload();
                    }
                }
            });
        }else{
            $('#error_message1').append('<span style="color:red"> This field is required </span>');
            $('#error_message1').delay(3000).fadeOut('slow');
            // $('#error_message').text() = '';
        }
    });
</script>
@endsection