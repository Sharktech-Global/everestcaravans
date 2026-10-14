@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Bookings</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.bookings.index') }}"><span class="breadcrumb-item active">Bookings</span></a>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Booking</h3>
        </div>
        <div class="block-content">
            
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <tbody>
                        <tr>
                            <th>Vehicle</th>
                            <td>{{ $enquiry->vehicle->name }}</td>
                        </tr>
                        <tr>
                            <th>Booking ID</th>
                            <td>{{ $enquiry->booking_id }}</td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td>{{ $enquiry->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{ $enquiry->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $enquiry->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $enquiry->phone }}</td>
                        </tr>
                        <tr>
                            <th>Billing Address</th>
                            <td>{{ $enquiry->billing_address }},&nbsp;{{ $enquiry->state }},&nbsp;{{ $enquiry->city }}&nbsp;Postcode:{{ $enquiry->postcode }}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>{{ @$enquiry->location->name }}</td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td>{{ $enquiry->payment }}</td>
                        </tr>
                        <tr>
                            <th>Proof</th>
                            <td> @foreach (json_decode($enquiry->vehicle_details) as $key => $value)
                                  @if($key == 'proof')<a href="{{asset('storage/'.$value)}}" target="_blank"> 
                                <img alt="Everest" src="{{asset('storage/'.$value)}}" width='100px' height='100px'> </a> 
                                 @endif <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Transaction Id</th>
                            <td>@if($enquiry->payment == 'cod'){{ @$enquiry->cod->txnid }} @else {{ @$enquiry->payments->txnid }}@endif</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>@if($enquiry->payment == 'cod'){{ @$enquiry->cod->amount }} @else {{ @$enquiry->payments->amount }}@endif</td>
                        </tr>
                        
                        <tr>
                            <th>Comments</th>
                            <td>{{ @$enquiry->comment }}</td>
                        </tr>
                        
                        
                        <!-- Add more rows for other fields as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="block-content">{{ $enquiries->links() }}</div> --}}
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
