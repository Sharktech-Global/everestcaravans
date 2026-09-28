@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Vehicle Details</h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
            <a class="breadcrumb-item" href="#"
                target="_blank">{{ $vehicle->name }}</a>
            <span class="breadcrumb-item active">Details</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Update Details</h3>
            </div>
            <div class="block-content">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                @endif
                <div class="block">
                    <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                        @foreach ($category_type as $data)
                            <li class="nav-item">
                                <a class="nav-link @if ($loop->first) active @endif" href="#btabs-alt-static-{{ @$data->id }}">{{ @$data->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="block-content tab-content">
                        @foreach ($category_type as $data)
                            <div class="tab-pane @if ($loop->first) active @endif" id="btabs-alt-static-{{ @$data->id }}" role="tabpanel">
                                <div id="accordion{{ $data->id }}">
                                    @if ($data->categories()->where('status', 1)->count())
                                        @foreach ($data->categories()->where('status', 1)->orderBy('name')->get() as $category)
                                            <div class="card">
                                                <div class="card-header"
                                                    id="heading{{ @$data->id }}{{ @$category->id }}">
                                                    <h5 class="mb-0">
                                                        <button style="background: #dedede;" type='button'
                                                            class="btn btn-link text-dark w-100 text-left"
                                                            data-toggle="collapse"
                                                            data-target="#collapse{{ @$data->id }}{{ @$category->id }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse{{ @$data->id }}{{ @$category->id }}">
                                                            {{ @$category->name }}
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div style="padding-bottom: 10px;background: #f0f2f5;"
                                                    id="collapse{{ @$data->id }}{{ @$category->id }}"
                                                    class="collapse px-3"
                                                    aria-labelledby="heading{{ @$data->id }}{{ @$category->id }}"
                                                    data-parent="#accordion{{ $data->id }}">
                                                    @if ($category->subCategories()->where('status', 1)->count())
                                                        @foreach ($category->subCategories()->where('status', 1)->orderBy('name')->get() as $subcat)
                                                            <form class="js-validation-vehicles-details mb-10"
                                                                id='details{{ $vehicle->id }}-{{ $category->id }}-{{$subcat->id}}' method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <div class="form-material">
                                                                                @php
                                                                                    $detail = $vehicle_detail
                                                                                        ->where('category_type_id', $data->id)
                                                                                        ->where('category_id', $category->id)
                                                                                        ->where('sub_category_id', $subcat->id)
                                                                                        ->first();
                                                                                @endphp
                                                                                <label
                                                                                    for="check_similar_{{ $subcat->id }}"
                                                                                    class="w-100">{{ @$subcat->name }}</label>
                                                                                <input type="checkbox" @if (@$detail->check_similar == 1) checked @endif
                                                                                    id='check_similar_{{ $subcat->id }}'
                                                                                    name="details[{{ $data->id }}][{{ $category->id }}][{{ $subcat->id }}][check_similar]"
                                                                                    value="1" class="check_similar"
                                                                                    onclick="similar_check('{{ $subcat->id }}')">
                                                                                <label
                                                                                    for="check_similar_{{ $subcat->id }}">
                                                                                    Same for all Varients?</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            @if ($vehicle->varients()->count())
                                                                                @foreach ($vehicle->varients()->get() as $variant)
                                                                                    <div class="col-md-4 float-left">
                                                                                        <div
                                                                                            class="form-material similar_child_{{ $subcat->id }}">
                                                                                            @php
                                                                                                $details = $vehicle_detail
                                                                                                    ->where('category_type_id', $data->id)
                                                                                                    ->where('category_id', $category->id)
                                                                                                    ->where('sub_category_id', $subcat->id)
                                                                                                    ->where('vehicle_variant_id', $variant->id)
                                                                                                    ->first();
                                                                                            @endphp
                                                                                            {{-- @dd($details); --}}
                                                                                            {{-- checked please check it --}}
                                                                                            <label class="w-100"
                                                                                                for="details">{{ $variant->name }}</label>
                                                                                            <input type="checkbox"
                                                                                                id='check'
                                                                                                name="details[{{ $data->id }}][{{ $category->id }}][{{ $subcat->id }}][{{ $variant->id }}][is_boolean]"
                                                                                                onchange="sync('{{ $subcat->id }}')"
                                                                                                value="1"
                                                                                                class="hide_input_check "
                                                                                                @if (@$details->is_boolean == 1) checked > @else > @endif Provide Yes
                                                                                                / No? <input type="text"
                                                                                                class="form-control input_text   @error('details[{{ $data->id }}][{{ $category->id }}][{{ $subcat->id }}][{{ $variant->id }}][text]') is-invalid @enderror

                                                                                                @if (@$details->is_boolean !=
                                                                                            null) d-none @endif"
                                                                                            onkeyup="sync('{{ $subcat->id }}')"
                                                                                            id="details"
                                                                                            name="details[{{ $data->id }}][{{ $category->id }}][{{ $subcat->id }}][{{ $variant->id }}][text]"
                                                                                            placeholder="Please Provide
                                                                                            Details"
                                                                                            @if (@$details->details)
                                                                                                value="{{ $details->details }}"
                                                                                            @endif>
                                                                                            @error('details[{{ $data->id }}][{{ $category->id }}][{{ $subcat->id }}][{{ $variant->id }}][text]')
                                                                                                <div class="invalid-feedback">
                                                                                                    {{ $message }}</div>
                                                                                            @enderror
                                                                                            <select
                                                                                                name="details[{{ $data->id }}][{{ $category->id }}][{{ $subcat->id }}][{{ $variant->id }}][status]"
                                                                                                class='form-control input_select @if (@$details->is_boolean == null) d-none @endif'
                                                                                                onchange="sync('{{ $subcat->id }}')"
                                                                                                id="status[{{ $data->id }}][{{ $category->id }}][{{ $subcat->id }}][{{ $variant->id }}]">
                                                                                                <option value="">Select</option>
                                                                                                <option @if (@$details->status == 0) selected @endif
                                                                                                    value="0">Yes</option>
                                                                                                <option @if (@$details->status == 1) selected @endif
                                                                                                    value="1">No</option>
                                                                                            </select>

                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                            <div
                                                                                class="col-md-4 float-left form-group pt-50">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <button
                                                                                            class="btn btn-success float-left"
                                                                                            id='submit' type='button'
                                                                                            onClick="submitForm(`{{ $vehicle->id }}`,`{{ $category->id }}`,`{{ $subcat->id }}`, event)">
                                                                                            Save</button>
                                                                                        <label
                                                                                            class="w-100 mt-3 text-success"
                                                                                            id='msg{{ $category->id }}'></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_after')
    <script src="{{ URL::asset('assets/js/notify.js') }}"></script>
    <script>
        $('.js-validation-vehicles-details').validate({
            ignore: "",
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: (error, e) => {
                $(e).parents('.form-group > div').append(error);
            },
            highlight: e => {
                $(e).closest('.form-group > div').removeClass('is-invalid').addClass('is-invalid');
            },
            success: e => {
                $(e).closest('.form-group > div').removeClass('is-invalid');
                $(e).remove();
            }
        });

        // $(".hide_input_check").prop("checked", false);
        $(".hide_input_check").click(function() {
            var select_box = $(this).siblings('.input_select');
            var input = $(this).siblings('.input_text');
            var yesorno = $(this).siblings('#yesorno');

            if ($(this).is(":checked")) {
                //checked
                $(input).addClass("d-none");
                $(select_box).removeClass("d-none");
                // $(yesorno).addClass("d-none");

            } else {
                $(select_box).find('option:selected').removeAttr("selected");
                //unchecked
                $(input).removeClass("d-none");
                // $(yesorno).removeClass("d-none");
                $(select_box).addClass("d-none");
            }
        })


        function similar_check(id) {
            var checker = document.getElementById('check_similar_' + id);
            if (checker.checked == true) {
                var input_check = $('.similar_child_' + id + ' .hide_input_check:first').is(':checked');
                // console.log(yesorno.);
                if (input_check == true) {
                    $('.similar_child_' + id + ' .input_select:not(:first)').removeClass("d-none");
                    $('.similar_child_' + id + ' .input_text:not(:first)').addClass("d-none");
                    $('.similar_child_' + id + ' .hide_input_check:not(:first)').prop('checked', true);

                    var select_box = $('.similar_child_' + id + ' .input_select:first').val();
                    if (select_box) {
                        // update values of all checkbox field except first
                        $('.similar_child_' + id + ' .input_select:not(:first)').val(select_box);
                        $('.similar_child_' + id + ' #yesorno:not(:first)').addClass("d-none");
                    }
                } else {
                    input_det = $('.similar_child_' + id + ' .input_text:first').val();
                    $('.similar_child_' + id + ' .input_select:not(:first)').addClass("d-none");
                    $('.similar_child_' + id + ' .input_text:not(:first)').removeClass("d-none");
                    $('.similar_child_' + id + ' #yesorno:not(:first)').removeClass("d-none");
                    $('.similar_child_' + id + ' .hide_input_check:not(:first)').prop('checked', false);
                    if (input_det) {
                        $('.similar_child_' + id + ' .input_text:not(:first)').val(input_det);
                    }
                }
            }
            // else{
            //         $('.similar_child_'+id+' .input_select:not(:first)').addClass("d-none");
            //         $('.similar_child_'+id+' .input_text:not(:first)').removeClass("d-none");
            //         $('.similar_child_'+id+' .hide_input_check:not(:first)').prop('checked', false);
            //         // $('.similar_child_'+id+' .input_text:not(:first)').val('') ;
            //         // $('.similar_child_'+id+' .input_select:not(:first)').val('');
            //         // $('.similar_child_'+id+' .hide_input_check:not(:first)').val('');
            // }

        }

        function sync(id) {
            similar_check(id);
        }

        function submitForm(vehicle, category, subcat, e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ route('admin.vehicles.details.store', $vehicle->id) }}',
                data: $('#details' + vehicle + '-' + category + '-' + subcat).serialize(),
                success: function(response) {
                    if (response.error) {
                        $.notify(response.error, "error");
                    }
                    $.notify(response.success, "success");
                }
            });
        }
    </script>
@endsection
