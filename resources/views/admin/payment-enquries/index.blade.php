@extends('admin.layouts.app')

@section('css_after')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
<div class="content">
    <h2 class="content-heading">Booking Enquiries</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Booking Enquiries</span>
    </nav>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="px-5 mx-5 mt-4 mb-5">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="text" name="date_from" id="date_from" class="form-control input-mask "
                                        placeholder="{{ __('Date From') }}" data-date-format="dd-mm-yyyy"
                                        data-provide="datepicker" data-date-autoclose="true" autocomplete="off"
                                        value="{{ request()->date_from }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="text" name="date_to" id="date_to" class="form-control input-mask "
                                        placeholder="{{ __('Date To') }}" data-date-format="dd-mm-yyyy"
                                        data-provide="datepicker" data-date-autoclose="true" autocomplete="off"
                                        value="{{ request()->date_to }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <button type="submit" class="w-auto btn btn-primary">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Booking Enquiries</h3>
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
            {{-- <div class="float-right mb-3">
                <form class="form-inline" action="" method="get" style="display:block;">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" name="search"
                        value="{{ @$search }}">
                    <button type="submit" class="btn btn-alt-primary">Search</button>
                </form>
            </div> --}}
            <div class="table-responsive">
                <table class="table table-striped table-vcenter service-enq" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer  Name</th>
                            <!-- <th>Last Name</th> -->
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Order Id</th> 
                            <th>Transaction Id</th> 
                            <th>Vehicle Name</th>
                            <th>Billing Address</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Data</th>
                            {{-- <th>URL</th>
                            <th>Referer</th> --}}
                            {{-- <th>Status</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if($enquiries->count())
                        @foreach ($enquiries as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="font-w600">{{ @$data->first_name }} {{ @$data->last_name }}</td>
                            <!-- <td class="font-w600"></td> -->

                            <td class="font-w600">{{ @$data->phone }}</td>
                            <td class="font-w600">{{ @$data->email }}</td>
                            <td class="font-w600">{{ @$data->payments->payable_id }}</td>
                            <td class="font-w600">{{ @$data->payments->txnid }}</td>
                            <td class="font-w600">{{ @$data->vehicle->title }}</td>
                            <td class="font-w600">{{ @$data->billing_address }}</td>
                            <td class="font-w600">{{ @$data->country->name }}</td>
                            <td class="font-w600">{{ @$data->state }}</td>
                            <td class="font-w600">{{ @$data->city }}</td>
                            <td class="font-w600">{{ @$data->amount }}</td>
                            <td class="font-w600">{{ @$data->status }}</td>
                            <td>{{ $data->created_at->format('d-m-Y h:i A') }}</td>
                            <td class="font-w600">{{ @$data->payments->data }}</td>

                            {{-- <td class="font-w600">{{ date("F j, Y", strtotime($data->service_date)) }}</td> --}}
                            {{-- <td class="font-w600">{{@$data->service_name}}</td> --}}
                            {{-- <td class="font-w600">{{@$data->service->title}}</td>
                            <td class="font-w600">{{ @$data->location->name }}</td>
                            <td>{{ $data->page_name }}</td>
                            <td>{{ @$data->refer }}</td> --}}
                           
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="8" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        {{-- <div class="block-content">{{ $enquiries->links() }}</div> --}}
    </div>
</div>
@endsection
@section('js_after')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $('#date_from').datepicker({
        todayHighlight: true
    });
    $('#date_to').datepicker({
    todayHighlight: true
    });
$(document).ready( function () {
        $('.service-enq').DataTable({
            dom: 'Bfrtip',
            buttons: [
                { extend: 'csv', text: 'Download' }
            ]
        });
    } );
    @if (session('error'))
    swal.fire({
        title: "Oh No!",
        text: "{{ session('error') }}",
        icon: 'error',
        timer: 3000,
        showCancelButton: false,
        showConfirmButton: false
    });
    @endif
    @if (session('success'))
        swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: 'success',
            timer: 3000,
            showCancelButton: false,
            showConfirmButton: false
        });
    @endif
</script>
@endsection
