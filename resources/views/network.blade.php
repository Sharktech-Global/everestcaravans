@extends('layouts.app_front')
@section('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/page.css') }}">
@endsection

@section('content')
    <!-- BANNER -->
    <section class="page-banner" style="background: url('{{ @$page->banner_image ? asset('storage/' . $page->banner_image) : asset('assets/images/background/default.png')}}') no-repeat center center; background-size: cover;">
    <div class="container text-center">
        <span class="text-white title">NETWORK</span>
        <div class="text-center breadcrumbs col-md-12">
            <p class="text-white"> <span><a class="text-white" 
                        href="{{ route('home') }}">Home</a></span> <i class="mx-2 fa fa-angle-right"
                    aria-hidden="true"></i> <span>NETWORK</span></p>
        </div>
    </div>
</section>
<!-- END OF BANNER -->


    <main id="content">
        <section class="pb-5 bg-black">
            <div class="container pt-5 mb-4">
                <div class="row">
                    <div class="mt-3 col-md-12">
                        <div id="ftabs">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">                                   
                                    @php                                     
                                    $first_loc_id = $main_networks->first()->id;
                                    @endphp
                                    @foreach ($main_networks as $networks)
                                        <a class="nav-item nav-link clicker @if($locationtab == 'drivingschool' && $networks->title == 'MARUTI DRIVING SCHOOLS' ) active @elseif ( $locationtab !== 'drivingschool'&& $locationtab !== 'service' && $locationtab !== 'usedcars' && $networks->title == 'SALES') active @elseif($locationtab == 'service' && $networks->title == 'SERVICE' && $locationtab !== 'drivingschool') active @elseif($locationtab == 'usedcars' && $networks->title == 'POPULAR USEDCARS' && $networks->title !== 'SALES' && $locationtab !== 'drivingschool') active  @endif"
                                            id="nav-{{ $networks->id }}-tab" data-toggle="tab"
                                            href="#nav-{{ $networks->id }}" role="tab"
                                            aria-controls="nav-{{ $networks->id }}" aria-selected="true"
                                            data-name='{{ $networks->title }}'>
                                            <h3 class="">{{ $networks->title }}</h3>
                                            @if ($locationtab == 'drivingschool' )
                                            @php $loc_id = $networks->id; @endphp  
                                            @elseif ($locationtab == 'service' && $networks->title == 'SERVICE' && $locationtab !== 'drivingschool' )
                                            @php $loc_id = $networks->id; @endphp    
                                            @elseif ($locationtab == 'usedcars'&& $networks->title == 'POPULAR USEDCARS' && $locationtab !== 'service' && $locationtab !== 'drivingschool' )  
                                            @php $loc_id =  $networks->id; @endphp
                                            {{-- @dd($loc_id);                            --}}
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </nav>
                            <div id="accordion" class="accord-sale mt-4">
                                @foreach ($brands as $brand)

                                @php
                                    $network = $network_branches->first();
                                @endphp
                                    <div class="card">
                                        <div class="card-header" id="heading-{{$brand->brand}}">
                                           
                                                <button class="btn btn-link text-uppercase darke" data-toggle="collapse"
                                                    data-target="#collapse-{{$brand->brand}}" aria-expanded="true"
                                                    aria-controls="collapse-{{$brand->brand}}">
                                                    {{$brand->brand}}
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                          
                                        </div>
                                        <div id="collapse-{{$brand->brand}}" class="collapse" aria-labelledby="heading-{{$brand->brand}}"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <div id="accordion-inner" class="mx-5">
                                                    @php
                                                       $brand_network =  $network->sub()->orderBy('created_at', 'ASC')->where('brand_id',$brand->id)->get();
                                                    @endphp
                                                    @foreach ($brand_network as $sub_branch)
                                                        <div class="card">
                                                            <div class="card-header" id="heading-{{ $sub_branch->id }}">
                                                                
                                                                    <button class="btn btn-link text-uppercase" data-toggle="collapse"
                                                                        data-target="#collapse-{{ $sub_branch->id }}" aria-expanded="true"
                                                                        aria-controls="collapse-{{ $sub_branch->id }}">
                                                                        {{ $sub_branch->sub_title }}
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                             
                                                            </div>
                                                            <div id="collapse-{{ $sub_branch->id }}" class="collapse"
                                                                aria-labelledby="heading-{{ $sub_branch->id }}" data-parent="#accordion-inner">
                                                                <div class="card-body">
                                                                    <table id="tablepress-{{ $sub_branch->id }}"
                                                                        class="table table-responsive w-100 tbpress">
                                                                        @if ($sub_branch->sub_title == 'SHOWROOMS')
                                                                            <thead>
                                                                                <tr class="row-1 odd" role="row">
                                                                                    <th
                                                                                        class="column-1 sorting_disabled">
                                                                                        &nbsp;</th>
                                                                                    <th
                                                                                        class="column-2 sorting_disabled">
                                                                                        Branches</th>
                                                                                    <th
                                                                                        class="column-3 sorting_disabled">
                                                                                        Branch Heads
                                                                                    </th>
                                                                                    <th
                                                                                        class="column-4 sorting_disabled">
                                                                                        Branch Address
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="row-hover">
                                                                                @foreach ($sub_branch->branch()->orderBy('created_at','DESC')->get() as $key => $all_branches)
                                                                                    <tr class="row-2 even"
                                                                                        role="row">
                                                                                        <td class="column-1">
                                                                                            {{ ++$key }}</td>
                                                                                        <td class="column-2">
                                                                                            {{ $all_branches->branch_name }}<br>
                                                                                            @if ($all_branches->website_link != null)<a href="{{ $all_branches->website_link }}" target="_blank"> View Map</a>@endif
                                                                                        </td>
                                                                                        <td class="column-3">
                                                                                            {{ @$all_branches->branch_head }}<br>
                                                                                            <a
                                                                                                href="tel:{{($all_branches->head_mobile) ? $all_branches->head_mobile : '#'}}">@if ($all_branches->head_mobile) Mob: @endif{{ @$all_branches->head_mobile }}</a><br>
                                                                                            <a
                                                                                                href="mailto:{{($all_branches->head_email) ? $all_branches->head_email : '#'}}">@if ($all_branches->head_email) Email: @endif{{ @$all_branches->head_email }}</a>
                                                                                        </td>
                                                                                        <td class="column-4">
                                                                                            {{ @$all_branches->branch_address }}<br>
                                                                                            <a
                                                                                                href="tel:{{($all_branches->address_mobile) ? $all_branches->address_mobile : '#'}}">@if ($all_branches->address_mobile) Ph: @endif{{ @$all_branches->address_mobile }}</a><br>
                                                                                            <a
                                                                                                href="mailto:{{($all_branches->address_email) ? $all_branches->address_email : '#'}}">@if ($all_branches->address_email) Email: @endif{{ @$all_branches->address_email }}</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach

                                                                            </tbody>
                                                                        @else
                                                                            <thead>
                                                                                <tr class="row-1 odd" role="row">
                                                                                    <th
                                                                                        class="column-1 sorting_disabled">
                                                                                        &nbsp;</th>
                                                                                    <th
                                                                                        class="column-2 sorting_disabled">
                                                                                        Branches</th>
                                                                                    <th
                                                                                        class="column-3 sorting_disabled">
                                                                                        Branch Heads
                                                                                    </th>
                                                                                    <th
                                                                                        class="column-4 sorting_disabled">
                                                                                        Branch Address
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="row-hover">
                                                                                @foreach ($sub_branch->branch()->orderBy('created_at','DESC')->get()   as $key => $all_branches)
                                                                                    <tr class="row-2 even"
                                                                                        role="row">
                                                                                        <td class="column-1">
                                                                                            {{ ++$key }}</td>
                                                                                        <td class="column-2">
                                                                                            {{ $all_branches->branch_name }}
                                                                                        </td>
                                                                                        <td class="column-3">
                                                                                            {{ @$all_branches->branch_head }}<br>
                                                                                            <a
                                                                                                href="tel:{{($all_branches->head_mobile) ? $all_branches->head_mobile : '#'}}">@if ($all_branches->head_mobile) Mob: @endif{{ @$all_branches->head_mobile }}</a><br>
                                                                                            <a
                                                                                                href="mailto:{{($all_branches->head_email) ? $all_branches->head_email : '#'}}">@if ($all_branches->head_email) Email: @endif{{ @$all_branches->head_email }}</a>
                                                                                        </td>
                                                                                        <td class="column-4">
                                                                                            {{ @$all_branches->branch_address }}<br>
                                                                                            <a
                                                                                                href="tel:{{($all_branches->address_mobile) ? $all_branches->address_mobile : '#'}}">@if ($all_branches->address_mobile) Ph: @endif{{ @$all_branches->address_mobile }}</a><br>
                                                                                            <a
                                                                                                href="mailto:{{($all_branches->address_email) ? $all_branches->address_email : '#'}}">@if ($all_branches->address_email) Email: @endif{{ @$all_branches->address_email }}</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach

                                                                            </tbody>
                                                                        @endif
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="px-3 text-center tab-content px-sm-0" id="nav-tabContent">

                                @foreach ($network_branches as $key => $branch)
                                @if($key == 0)
                                @continue
                                @endif
                                    {{-- loop starts --}}

                                    <div class="nav-{{ $branch->id }}-tab tab-pane   @if ($branch->title == 'SALES' ) active show  @endif serv" id="nav-{{ $branch->id }}"
                                        role="tabpanel" aria-labelledby="nav-{{ $branch->id }}-tab">
                                        
                                        <div class="bs-sales">
                                            <div class="accordion" id="accordion-{{ $branch->id }}">
                                                {{-- card start --}}
                                                @foreach ($branch->sub()->orderBy('created_at', 'ASC')->get()
        as $sub_branch)
                                                    {{-- @dd($sub_branch->branch); --}}
                                                    @if ($sub_branch->branch != '[]')
                                                        <div class="card">
                                                            <div class="card-header"
                                                                id="heading-showroom{{ $sub_branch->id }}">
                                                               
                                                                    <button type="button" class="btn btn-link collapsed"
                                                                        data-toggle="collapse"
                                                                        data-target="#collapseOne{{ $sub_branch->id }}">
                                                                        <i class="fa fa-plus"></i>
                                                                        {{ @$sub_branch->sub_title }}</button>
                                                                
                                                            </div>
                                                            {{-- static data --}}

                                                            {{-- end --}}
                                                            <div id="collapseOne{{ $sub_branch->id }}"
                                                                class="collapse"
                                                                aria-labelledby="heading-showroom{{ $sub_branch->id }}"
                                                                data-parent="#accordion-{{ $branch->id }}">
                                                                <div class="card-body">
                                                                    @if ($branch->title == 'SERVICE')
                                                                        <table id="tablepress-{{ $sub_branch->id }}"
                                                                            class="table table-responsive w-100 tbpress">
                                                                            <thead>
                                                                                <tr class="row-1 odd" role="row">
                                                                                    <th class="column-1 sorting_disabled">
                                                                                        &nbsp;</th>
                                                                                    <th class="column-2 sorting_disabled">
                                                                                        Branches</th>
                                                                                    <th class="column-3 sorting_disabled">
                                                                                        Location</th>
                                                                                    {{-- <th class="column-3 sorting_disabled">
                                                                                            Branch Head</th> --}}
                                                                                    <th class="column-3 sorting_disabled">
                                                                                        Branch Address</th>
                                                                                    {{-- <th class="column-4 sorting_disabled">WM
                                                                                        Name </th> --}}
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="row-hover">
                                                                                @foreach ($sub_branch->branch as $key => $all_branches)
                                                                                    <tr class="row-2 even" role="row">
                                                                                        <td class="column-1">
                                                                                            {{ ++$key }}</td>
                                                                                        <td class="column-2">
                                                                                            {{ $all_branches->branch_name }}
                                                                                        </td>
                                                                                        <td class="column-3">
                                                                                            {{ @$all_branches->location }}
                                                                                        </td>
                                                                                        {{-- <td class="column-4">
                                                                                        @if(@$all_branches->branch_head) Branch Head - {{@$all_branches->branch_head}}@endif<br>
                                                                                        @if(@$all_branches->head_email) <a
                                                                                        href="mailto:{{@$all_branches->head_email}}">{{@$all_branches->head_email}}</a>@endif<br>
                                                                                        @if(@$all_branches->head_mobile) Mob: <a
                                                                                        href="tel:{{@$all_branches->head_mobile}}">{{@$all_branches->head_mobile}}</a>@endif<br>
                                                                                    </td> --}}
                                                                                        <td class="column-4">
                                                                                           
                                                                                            {{ @$all_branches->branch_address }}<br>
                                                                                            <a
                                                                                                href="tel:{{($all_branches->address_mobile) ? $all_branches->address_mobile : '#'}}">@if ($all_branches->address_mobile) Mob: @endif{{ @$all_branches->address_mobile }}</a><br>
                                                                                            <a
                                                                                                href="mailto:{{($all_branches->address_email) ? $all_branches->address_email : '#'}}">@if ($all_branches->address_email) Email: @endif{{ @$all_branches->address_email }}</a>
                                                                                        </td>
                                                                                        {{-- <td class="column-3">
                                                                                            
                                                                                            {{ @$all_branches->wm_name }}
                                                                                        </td> --}}
                                                                                    </tr>
                                                                                @endforeach

                                                                            </tbody>
                                                                        </table>
                                                                    @elseif($branch->title == "SALES")

                                                                        {{-- <table id="tablepress-{{ $sub_branch->id }}"
                                                                            class="table table-responsive w-100 tbpress">
                                                                            @if ($sub_branch->sub_title == 'SHOWROOMS')
                                                                                <thead>
                                                                                    <tr class="row-1 odd" role="row">
                                                                                        <th
                                                                                            class="column-1 sorting_disabled">
                                                                                            &nbsp;</th>
                                                                                        <th
                                                                                            class="column-2 sorting_disabled">
                                                                                            Branches</th>
                                                                                        <th
                                                                                            class="column-3 sorting_disabled">
                                                                                            Branch Heads
                                                                                        </th>
                                                                                        <th
                                                                                            class="column-4 sorting_disabled">
                                                                                            Branch Address
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="row-hover">
                                                                                    @foreach ($sub_branch->branch as $key => $all_branches)
                                                                                        <tr class="row-2 even"
                                                                                            role="row">
                                                                                            <td class="column-1">
                                                                                                {{ ++$key }}</td>
                                                                                            <td class="column-2">
                                                                                                {{ $all_branches->branch_name }}<br>
                                                                                                @if ($all_branches->website_link != null)<a href="{{ $all_branches->website_link }}" target="_blank"> View Map</a>@endif
                                                                                            </td>
                                                                                            <td class="column-3">
                                                                                                {{ @$all_branches->branch_head }}<br>
                                                                                                <a
                                                                                                    href="#">@if ($all_branches->head_mobile) Mob: @endif{{ @$all_branches->head_mobile }}</a><br>
                                                                                                <a
                                                                                                    href="#">@if ($all_branches->head_email) Email: @endif{{ @$all_branches->head_email }}</a>
                                                                                            </td>
                                                                                            <td class="column-4">
                                                                                                {{ @$all_branches->branch_address }}<br>
                                                                                                <a
                                                                                                    href="#">@if ($all_branches->address_mobile) Ph: @endif{{ @$all_branches->address_mobile }}</a><br>
                                                                                                <a
                                                                                                    href="#">@if ($all_branches->address_email) Email: @endif{{ @$all_branches->address_email }}</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach

                                                                                </tbody>
                                                                            @else
                                                                                <thead>
                                                                                    <tr class="row-1 odd" role="row">
                                                                                        <th
                                                                                            class="column-1 sorting_disabled">
                                                                                            &nbsp;</th>
                                                                                        <th
                                                                                            class="column-2 sorting_disabled">
                                                                                            Branches</th>
                                                                                        <th
                                                                                            class="column-3 sorting_disabled">
                                                                                            Branch Heads
                                                                                        </th>
                                                                                        <th
                                                                                            class="column-4 sorting_disabled">
                                                                                            Branch Address
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="row-hover">
                                                                                    @foreach ($sub_branch->branch as $key => $all_branches)
                                                                                        <tr class="row-2 even"
                                                                                            role="row">
                                                                                            <td class="column-1">
                                                                                                {{ ++$key }}</td>
                                                                                            <td class="column-2">
                                                                                                {{ $all_branches->branch_name }}
                                                                                            </td>
                                                                                            <td class="column-3">
                                                                                                {{ @$all_branches->branch_head }}<br>
                                                                                                <a
                                                                                                    href="#">@if ($all_branches->head_mobile) Mob: @endif{{ @$all_branches->head_mobile }}</a><br>
                                                                                                <a
                                                                                                    href="#">@if ($all_branches->head_email) Email: @endif{{ @$all_branches->head_email }}</a>
                                                                                            </td>
                                                                                            <td class="column-4">
                                                                                                {{ @$all_branches->branch_address }}<br>
                                                                                                <a
                                                                                                    href="#">@if ($all_branches->address_mobile) Ph: @endif{{ @$all_branches->address_mobile }}</a><br>
                                                                                                <a
                                                                                                    href="#">@if ($all_branches->address_email) Email: @endif{{ @$all_branches->address_email }}</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach

                                                                                </tbody>
                                                                            @endif
                                                                        </table>--}}
                                                                    @else
                                                                        <table id="tablepress-{{ $sub_branch->id }}"
                                                                            class="table table-responsive w-100 tbpress">
                                                                            <thead>
                                                                                <tr class="row-1 odd" role="row">
                                                                                    <th class="column-1 sorting_disabled">
                                                                                        &nbsp;</th>
                                                                                    <th class="column-2 sorting_disabled">
                                                                                        Branches</th>
                                                                                    <th class="column-3 sorting_disabled">
                                                                                        Branch Heads
                                                                                    </th>
                                                                                    <th class="column-4 sorting_disabled">
                                                                                        Branch Address
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="row-hover">
                                                                                @foreach ($sub_branch->branch as $key => $all_branches)
                                                                                    <tr class="row-2 even" role="row">
                                                                                        <td class="column-1">
                                                                                            {{ ++$key }}</td>
                                                                                        <td class="column-2">
                                                                                            {{ $all_branches->branch_name }}<br>
                                                                                            @if ($all_branches->website_link)<a href="{{ $all_branches->website_link }}" target="_blank"> View Map</a></td> @endif
                                                                                        <td class="column-3">
                                                                                            {{ @$all_branches->branch_head }}<br>
                                                                                            <a
                                                                                                href="tel:{{($all_branches->head_mobile) ? $all_branches->head_mobile : '#'}}">@if ($all_branches->head_mobile) Mob: @endif{{ @$all_branches->head_mobile }}</a><br>
                                                                                            <a
                                                                                                href="mailto:{{($all_branches->head_email) ? $all_branches->head_email : '#'}}">@if ($all_branches->head_email) Email: @endif{{ @$all_branches->head_email }}</a>
                                                                                        </td>
                                                                                        <td class="column-4">
                                                                                            {{ @$all_branches->branch_address }}<br>
                                                                                            <a
                                                                                                href="tel:{{($all_branches->address_mobile) ? $all_branches->address_mobile : '#'}}">@if ($all_branches->address_mobile) Ph: @endif{{ @$all_branches->address_mobile }}</a><br>
                                                                                            <a
                                                                                                href="mailto:{{($all_branches->address_email) ? $all_branches->address_email : '#'}}">@if ($all_branches->address_email) Email: @endif{{ @$all_branches->address_email }}</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach

                                                                            </tbody>
                                                                        </table>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                @endforeach
                                                {{-- card end --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- loops end --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
    <input type='hidden' class='locationtab' value='{{@$locationtab}}'>
    <input type='hidden' class='locationid' value='{{@$loc_id}}'>
    <input type='hidden' class='firstlocationid' value='{{@$first_loc_id}}'>
    
@endsection
@section('js_after')
<script>
        var locationtab = $('.locationtab').val();
        var locationid = $('.locationid').val();
        var firstlocationid = $('.firstlocationid').val();
        
            if(locationtab == 'drivingschool'){
                $('#nav-'+locationid+'.tab-pane').addClass('active show');
                $('#nav-'+firstlocationid+'.tab-pane').removeClass('active show');
                $('.accord-sale').addClass('d-none');
                $('a').on('click', function() {
                    $('.accord-sale').removeClass('d-none');
                    $('.serv').addClass('d-none');                
                });
            }else if(locationtab == 'service'){    
                $('#nav-'+locationid+'.tab-pane').addClass('active show');
                $('.accord-sale').addClass('d-none');
            } else if(locationtab == 'usedcars'){    
                $('#nav-'+locationid+'.tab-pane').addClass('active show');
                // console.log(locationid);
                $('.accord-sale').addClass('d-none');
                // $('a').find(`[data-name='SALES']`).removeClass('active');
            }          
    </script>

    <script>
        $(document).ready(function() {
            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function() {
                $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function() {
                $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
            });
        });
    </script>
    <script>
        $('a').on('click', function() {
            var val = $(this).attr("data-name");
            if (val == 'SALES') {
                $('.accord-sale').removeClass('d-none');
                $('.serv').addClass('d-none');
            } else if(val == 'SERVICE' || val == 'POPULAR USEDCARS' || val == 'MARUTI DRIVING SCHOOLS' ) {
                $('.accord-sale').addClass('d-none');
                $('.serv').removeClass('d-none');
                // $('#brand option:selected').removeAttr('selected');
            }
        });
    </script>

@endsection
