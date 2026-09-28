@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Bookings</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Bookings</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Bookings</h3>
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
                <table class="table table-striped table-vcenter" id='myTable'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Vehicle</th>
                            {{-- <th>Vehicle Details</th> --}}
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            {{-- <th>Transaction Id</th> --}}
                            <th>Location</th>
                            {{-- <th>Billing Address</th> --}}
                            {{-- <th>Comments</th> --}}
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($enquiries->count())
                        @foreach ($enquiries as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="font-w600">{{ @$data->vehicle->name }}</td>
                            {{-- <td>
                                <label class="bg-F4F4F4 p-3 w-100 float-left br-50">
                                    <small>
                                        @foreach (json_decode($data->vehicle_details) as $key => $value)
                                        - {{ strtoupper($key) }}: @if($key == 'proof') <a href="{{asset('storage/'.$value)}}" target="_blank"> 
                                        <img alt="abreco" src="{{asset('storage/'.$value)}}" width='100px' height='100px'> </a> @else {{ $value }} @endif <br>
                                        @endforeach
                                    </small> <br>
                                </label>
                            </td> --}}
                            <td class="font-w600">{{ $data->first_name }}&nbsp;{{ $data->last_name }}</td>
                            <td class="font-w600">{{ $data->email }}</td>
                            <td class="font-w600">{{ $data->phone }}</td>
                            {{-- <td class="font-w600">{{ @$data->payments->txnid }}</td> --}}
                            <td class="font-w600">{{ @$data->location->name }}</td>
                            {{-- <td class="font-w600">
                                {{ $data->billing_address }},&nbsp;{{ $data->state }},&nbsp;{{ $data->city }}&nbsp;Postcode:{{ $data->postcode }}
                            </td> --}}
                            {{-- <td class="font-w600">{{ $data->comment }}</td> --}}

                            <td class="font-w600">{{ strtoupper($data->payment) }}</td>
                            <td class="font-w600">
                                @if($data->status == "success")
                                    <span class="badge badge-success">Success</span>
                                @elseif($data->status == "pending")
                                    <span class="badge badge-danger">Pending</span>
                                @else
                                    <span class="badge badge-danger">Failed</span>
                                @endif

                            </td>
                            <td>{{ $data->created_at->format('d-m-Y h:i A') }}</td>
                            <td><a href='{{route('admin.bookings.show',$data->id)}}' class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="View Booking Details" data-original-title="View Booking Details">View</a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="10" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        <div class="block-content">{{ $enquiries->links() }}</div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
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
