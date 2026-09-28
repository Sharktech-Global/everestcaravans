@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Locations</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Locations</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Locations</h3>
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
            {{--  <div class="float-right mb-3">
                <form class="form-inline" action="" method="get" style="display:block;">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" name="search"
                        value="{{ @$search }}">
                    <button type="submit" class="btn btn-alt-primary">Search</button>
                </form>
            </div>  --}}
            <div class="table-responsive">
                <table class="table table-striped table-vcenter" id='locs_table'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Location Type</th>
                            <th>Showroom Type</th>
                            <th>Email</th>
                            <th>Email CCs</th>
                            <th>Email BCCs</th>
                            <th>Phone Numbers</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($locations->count())
                        @foreach ($locations as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="font-w600">{{ @$data->name }}</td>
                            <td class="font-w600">{{ @$data->type->name }}</td>
                            <td class="font-w600">{{ @$data->showroom }}</td>
                            <td class="font-w600">{{ $data->email }}</td>
                            <td class="font-w600">{{ $data->email_ccs}}</td>
                            <td class="font-w600">{{ $data->email_bccs}}</td>
                            <td class="font-w600">{{ $data->phone_numbers}}</td>
                            <td class="font-w600">{{ $data->order}}</td>
                            <td>
                                @if ($data->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.locations.edit',$data->id) }}"
                                        class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        title="Delete"
                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete this location?')){ document.getElementById('delete-data-{{ $data->id }}').submit();}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="delete-data-{{ $data->id }}"
                                        action="{{ route('admin.locations.destroy',$data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="9" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        {{--  <div class="block-content">{{ $locations->links() }}</div>  --}}
    </div>
</div>
@endsection

@section('js_after')
    <script>
    $(document).ready( function () {
        $('#locs_table').DataTable();
    } );
    </script>
@endsection
