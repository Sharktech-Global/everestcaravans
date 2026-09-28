@extends('admin.layouts.app')

@section('css_after')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
<div class="content">
    <h2 class="content-heading">Enquiries</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Enquiries</span>
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
            <h3 class="block-title">View  Enquiries</h3>
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
{{--            
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Model</th>
                            <th>Service</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($enquiries->count())
                        @foreach ($enquiries as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="font-w600">{{ $data->name }}</td>
                            <td class="font-w600">{{ $data->email }}</td>
                            <td class="font-w600">{{ $data->phone }}</td>
                            <td class="font-w600">{{ $data->location }}</td>
                            <td class="font-w600">{{ $data->vehicle->name }}</td>
                            <td class="font-w600">
                                @foreach (json_decode($data->service) as $key => $value)
                                @if($loop->last) {{$value}} @else {{$value}}, @endif
                                @endforeach
                            </td>
                            <td>{{ $data->created_at->format('d-m-Y h:i A') }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="8" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div> --}}

            <div class="table-responsive">
                <table class="table table-striped table-vcenter" id='vehicle-enquirey'>
                    <thead>
                        
                        <tr>
                            <th>Enquiry Type</th>
                            <th>Created</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Model</th>                            
                            <th>Service Date</th>
                            <th>Service Name</th>
                            <th>Registration Number</th>
                            <th>Location</th>
                            <th>Vehicle</th>
                            <th>Page</th>
                            <th>Status</th>
                            <th>Year</th>
                            
                        </tr>
                    </thead>
                    <tbody>                      
                        @foreach ($enquiries as $data)
                        <tr>
                           <td>Vehicle Enquiry</td>
                            <td>{{ $data->created_at->format('d-m-Y h:i A') }}</td>
                            <td class="font-w600">{{ $data->name }}</td>
                            <td class="font-w600">{{ $data->phone }}</td>
                            <td class="font-w600">{{ $data->email }}</td>
                            <td class="font-w600"></td>
                            <td class="font-w600"></td>
                            <td class="font-w600"></td>
                            <td class="font-w600"></td>
                            <td class="font-w600">{{ $data->location->name }}</td>
                            <td class="font-w600">{{ $data->vehicle->name }}</td>
                            <td>{{ $data->page_name}}</td>
                            <td class="font-w600">
                                @if ($data->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">OTP not verified</span>
                                @endif
                            </td>    
                            <td></td>

                        </tr>
                        @endforeach
                        {{-- <tr><td>"</td></tr> --}}
                        @foreach ($ServiceEnquiry as $data)
                        <tr>
                           <td>Service Enquiry</td> 
                            <td>{{ $data->created_at->format('d-m-Y h:i A') }}</td>
                            <td class="font-w600">{{ $data->name }}</td>
                            <td class="font-w600">{{ $data->phone }}</td>
                            <td class="font-w600">{{ $data->email }}</td>

                            <td class="font-w600">{{ $data->model }}</td>
                            <td class="font-w600">{{ date("F j, Y", strtotime($data->service_date)) }}</td>
                            <td class="font-w600">{{@$data->service_name}}</td>
                            <td class="font-w600"></td>
                            <td class="font-w600">{{ $data->location->name }}</td>
                            <td class="font-w600"></td>
                            <td>{{ $data->page_name }}</td>
                            <td class="font-w600">
                                @if ($data->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">OTP not verified</span>
                                @endif
                            </td>
                            <td></td>

                        </tr>
                        @endforeach
                        @foreach ($InsuranceEnquiry as $data)
                        <tr>
                            <td>Insurance Enquiry</td> 
                            <td>{{ $data->created_at->format('d-m-Y h:i A') }}</td>
                            <td class="font-w600">{{ $data->name }}</td>
                            {{-- <td class="font-w600">{{ $data->email }}</td> --}}
                            <td class="font-w600">{{ $data->mobile }}</td>
                            <td class="font-w600">{{ $data->email }}</td>
                            <td class="font-w600"></td>
                            <td class="font-w600"></td>
                            <td class="font-w600"></td>

                            <td class="font-w600">{{ $data->reg_number }}</td>
                            <td class="font-w600">{{ $data->location->area->first()->name }}</td>
                            <td class="font-w600"></td>

                            <td>{{ $data->page_name }}</td>
                            <td class="font-w600">
                                @if ($data->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">OTP not verified</span>
                                @endif
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                        @foreach ($exchange as $data)
                        <tr>
                            <td>
                               Exchange Enquiry
                            </td>
                            <td>{{ $data->created_at->format('d-m-Y h:i A') }}</td>
                            <td class="font-w600">{{ $data->name }}</td>
                            <td class="font-w600">{{ $data->phone }}</td>
                            <td class="font-w600"></td>
                            <td class="font-w600">{{ $data->vehicle_id }}</td>
                            <td class="font-w600"></td>
                            <td class="font-w600"></td>
                            <td class="font-w600"></td>
                            <td class="font-w600">{{ $data->location->area->first()->name }}</td>
                            
                            <td class="font-w600"></td>
                           
                            <td>{{ $data->page_name }}</td>
                            <td class="font-w600">
                                @if ($data->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">OTP not verified</span>
                                @endif
                            </td>
                             <td class="font-w600">{{ $data->year }}</td>
                            

                        </tr>
                        @endforeach
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
    $('#vehicle-enquirey').DataTable({
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
