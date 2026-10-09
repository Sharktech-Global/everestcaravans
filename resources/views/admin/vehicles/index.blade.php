@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Vehicles</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Vehicles</span>
        </nav>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">View Vehicles</h3>
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
                        <input type="text" class="mb-2 form-control mr-sm-2 mb-sm-0" id="search" name="search"
                            value="{{ @$search }}">
                        <button type="submit" class="btn btn-alt-primary">Search</button>
                    </form>
                </div> --}}
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter" id='mytable'>
                        <thead>
                            <tr>
                                <th>No </th>
                                <th>Name </th>
                                <th>Slug </th>
                                {{-- <th>Title</th> --}}
                                {{-- <th>Tagline</th> --}}
                                <th>Status </th>
                                {{-- <th>Landing Page</th> --}}
                                <th>Settings </th>
                                <th>Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($vehicles->count())
                                @foreach ($vehicles as $data)
                                    <tr>
                                        <td>
                                           
                                      {{ ($vehicles->currentpage()-1) * $vehicles->perpage() + $loop->index + 1 }}
                                             
                                        </td>
                                        <td class="font-w600">{{ $data->name }}</td>
                                        <td>{{ $data->slug }}</td>
                                        {{-- <td class="font-w600">{{ $data->title }}</td> --}}
                                        {{-- <td class="font-w600">{!! $data->tagline !!}</td> --}}
                                        <td>
                                            @if ($data->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    @if ($data->has_landing)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" data-val="1" data-id="{{ $data->id }}"
                                                        href="#">Active</a>
                                                    <a class="dropdown-item" data-val="0" data-id="{{ $data->id }}"
                                                        href="#">Inactive</a>
                                                </div>
                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="btn-group">
                                                @if (!@$data->vehicle_type->has_sales_page)
                                                    <!-- <a href="{{ route('admin.vehicles.editions.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Vehicle editions">Editions</a> -->
                                                    <!-- <a href="{{ route('admin.vehicles.faq.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Complete Vehicle Details">FAQ</a> -->
                                                    <!-- <a href="{{ route('admin.vehicles.content.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Complete Vehicle Details">Content</a> -->
                                                    {{-- <a href="{{ route('admin.vehicles.details.index', $data->id) }}"
                                                    class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                    title="Complete Vehicle Details">Details</a> --}}
                                                    <!-- <a href="{{ route('admin.vehicles.details.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Complete Vehicle Details">Details</a> -->
                                                    <!-- <a href="{{ route('admin.vehicles.features.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Complete Vehicle Details">Features</a> -->
                                                    <a href="{{ route('admin.vehicles.seo.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="SEO">SEO</a>
                                                    <a href="{{ route('admin.vehicles.sections.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Detail Sections">Sections</a>
                                                    <!-- <a href="{{ route('admin.vehicles.varients.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Vehicle Variants">Variants</a> -->
                                                    <!-- <a href="{{ route('admin.vehicles.colors.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Colors">Colors</a> -->
                                                    <!-- <a href="{{ route('admin.vehicles.gallery.index', $data->id) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Gallery">Gallery</a> -->
                                                @endif
                                                <a href="{{ route('admin.vehicles.edit', $data->id) }}"
                                                    class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                    title="Edit">Edit</a>

                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="event.preventDefault(); if(confirm('Are you sure to delete this vehicle {{ $data->name }} ?')){ document.getElementById('delete-data-{{ $data->id }}').submit();}">
                                                Delete
                                            </button>
                                            <form id="delete-data-{{ $data->id }}"
                                                action="{{ route('admin.vehicles.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
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
            <div class="block-content">{{ $vehicles->links() }}</div>
        </div>
    </div>
@endsection
@section('js_after')
    <script src="{{ URL::asset('assets/js/notify.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#mytable').DataTable({
                "iDisplayLength": 50, 
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
        $(function() {
            $(".dropdown-menu").on('click', 'a', function(e) {
                e.preventDefault()
                $(this).parents('.dropdown').find('button').text($(this).text());
                var status = $(this).data('val');
                var vehicle = $(this).data('id');
                var url = "{{ route('admin.vehicles.update', ':id') }}";
                url = url.replace(':id', vehicle);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        _method: "PUT",
                        status: status,
                    },
                    success: function(res) {
                        if (res.status) {
                            $.notify(res.message, "success");
                        } else {
                            $.notify(res.message, "error");
                        }
                    }
                });
            });
        });
    </script>
@endsection
