@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Service Content</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Service Content</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Service Content</h3>
        </div>
        <div class="block-contefnt">
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
            <div class="float-right mb-3">
                <form class="form-inline" action="" method="get" style="display:block;">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" name="search" value="{{ @$search }}">
                    <button type="submit" class="btn btn-alt-primary">Search</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th width="60%">Title</th>
                            <th width="60%">Service</th>
                            <th width="10%">Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($pages->count())
                        @foreach ($pages as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration  + $pages->firstItem() - 1 }}
                            </td>
                            <td class="font-w600">{{ $data->name }}</td>
                            <td class="font-w600">{{ $data->services->title }}</td>
                            <td>
                                @if ($data->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('service_content.edit',$data->id) }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">Edit</a>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Delete" onclick="event.preventDefault(); if(confirm('Are you sure to delete this additional page?')){ document.getElementById('delete-data-{{ $data->id }}').submit();}">
                                        Delete
                                    </button>
                                    <form id="delete-data-{{ $data->id }}" action="{{ route('service_content.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="4" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        <div class="block-content">{{ $pages->links() }}</div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    @if(session('error'))
    swal.fire({
        title: "Oh No!",
        text: "{{ session('error') }}",
        icon: 'error',
        timer: 3000,
        showCancelButton: false,
        showConfirmButton: false
    });
    @endif
    @if(session('success'))
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