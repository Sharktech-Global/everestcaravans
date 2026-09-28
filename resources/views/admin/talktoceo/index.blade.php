@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Talk To CEO Enquiries</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Talk To CEO</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Talk To CEO Enquiries</h3>
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
                <table class="table table-striped table-vcenter talktoCeo">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Location</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($talktoceo->count())
                        @foreach ($talktoceo as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="font-w600">{{ @$data->name }}</td>
                            <td class="font-w600">{{ @$data->email }}</td>
                            <td class="font-w600">{{ @$data->phone }}</td>
                            <td class="font-w600">{{ @$data->subject }}</td>
                            <td class="font-w600">{{ @$data->message }}</td>
                            <td class="font-w600">{{ @$data->location->name }}</td>
                            <td>{{ $data->created_at->format('d-m-Y h:i A') }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="6" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        {{-- <div class="block-content">{{ $talktoceo->links() }}</div> --}}
    </div>
</div>
@endsection
@section('js_after')
<script>
    $(document).ready( function () {
        $('.talktoCeo').DataTable({
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
