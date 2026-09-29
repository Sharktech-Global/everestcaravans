@extends('admin.layouts.app')
@section('content')
<div class="content">
    <div class="row invisible" data-toggle="appear">
     <div class="col-6 col-xl-3">
            <a class="block block-rounded block-bordered block-link-shadow" href="{{ route('admin.locations.index') }}">
                <div class="block-content block-content-full clearfix">
                    <div class="float-right mt-15 d-none d-sm-block">
                        <i class="fas fa-map-marker fa-2x text-primary-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-primary" data-toggle="countTo" data-speed="1000"
                        data-to="{{ $locations }}">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Locations</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-rounded block-bordered block-link-shadow" href="{{ route('admin.vehicles.index') }}">
                <div class="block-content block-content-full clearfix">
                    <div class="float-right mt-15 d-none d-sm-block">
                        <i class="fas fa-car fa-2x text-primary-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-primary" data-toggle="countTo" data-speed="1000"
                        data-to="{{ $vehicles }}">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Vehicles</div>
                </div>
            </a>
        </div>
        <!-- Row #1 -->
        <div class="col-6 col-xl-3">
            <a class="block block-rounded block-bordered block-link-shadow" href="{{ route('admin.bookings.index') }}">
                <div class="block-content block-content-full clearfix">
                    <div class="float-right mt-15 d-none d-sm-block">
                        <i class="fas fa-book fa-2x text-primary-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-primary" data-toggle="countTo" data-speed="1000"
                        data-to="{{ $book }}">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Bookings</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-xl-3">
            <a class="block block-rounded block-bordered block-link-shadow"
                href="{{ route('admin.vehicle-enquiries.index') }}">
                <div class="block-content block-content-full clearfix">
                    <div class="float-right mt-15 d-none d-sm-block">
                        <i class="fa fa-wpforms fa-2x text-earth-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-earth"><span data-toggle="countTo" data-speed="1000"
                            data-to="{{$vEnquiries}}">0</span></div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Vehicle Enquiry</div>
                </div>
            </a>
        </div>
        {{-- <div class="col-6 col-xl-3">
            <a class="block block-rounded block-bordered block-link-shadow"
                href="{{ route('admin.test-drive-enquiries.index') }}">
                <div class="block-content block-content-full clearfix">
                    <div class="float-right mt-15 d-none d-sm-block">
                        <i class="fa fa-wpforms fa-2x text-elegance-light"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-elegance" data-toggle="countTo" data-speed="1000"
                        data-to="{{ $tdEnquiries }}">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Test Drive Enquiry</div>
                </div>
            </a>
        </div> --}}
        {{-- <div class="col-6 col-xl-3">
            <a class="block block-rounded block-bordered block-link-shadow"
                href="{{ route('admin.service-enquiries.index') }}">
                <div class="block-content block-content-full clearfix">
                    <div class="float-right mt-15 d-none d-sm-block">
                        <i class="fa fa-wpforms fa-2x text-pulse"></i>
                    </div>
                    <div class="font-size-h3 font-w600 text-pulse" data-toggle="countTo" data-speed="1000"
                        data-to="{{ $sEnquiries }}">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Service Enquiry</div>
                </div>
            </a>
        </div> --}}
        <!-- END Row #1 -->
    </div>
    <div class="row invisible" data-toggle="appear">
        <!-- Row #3 -->
        <div class="col-md-12">
            <div class="block block-rounded block-bordered">
                <div class="block-header block-header-default border-b">
                    <h3 class="block-title">Latest Bookings</h3>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-striped">
                        <thead>
                            <tr>
                                <th style="width: 100px;">No</th>
                                <th>Booking Location</th>
                                <th class="d-none d-sm-table-cell">Customer</th>
                                <th class="text-right">Status</th>
                                <th class="text-right">Date Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($bookings->count())
                            @foreach ($bookings->take(10) as $data)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ @$data->location->name }}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{ $data->first_name }}&nbsp;{{ $data->last_name }}
                                </td>
                                <td class="text-right">
                                    @switch($data->payment)

                                    @case('cod')
                                    {!! ($data->cod)? '<span class="badge badge-success">Completed</span>':'<span
                                        class="badge badge-danger">Failed</span>'
                                    !!}
                                    @break
                                    @case('federal')
                                    {!! ($data->federal_payments()->whereStatus(1)->count())? '<span
                                        class="badge badge-success">Completed</span>':'<span
                                        class="badge badge-danger">Failed</span>' !!}
                                    @break

                                    @endswitch
                                </td>
                                <td class="text-right">
                                    {{ date("F j, Y", strtotime($data->created_at)) }}
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="no-data">
                                <td colspan="5" class="text-center">No data available in table</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
