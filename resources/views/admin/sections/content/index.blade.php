@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Sections Content</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Sections</span>
        </nav>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">View Sections</h3>
                <div class="page-title-right">
                    <a href="{{ route('admin.sections.content.create',@$sections->id) }}" class="btn btn-primary w-md">{{ __('Create Section Content') }}</a>
                </div>
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
                <div class="float-right mb-3">
                    <form class="form-inline" action="" method="get" style="display:block;">
                        <input type="text" class="mb-2 form-control mr-sm-2 mb-sm-0" id="search" name="search"
                            value="{{ @$search }}">
                        <button type="submit" class="btn btn-alt-primary">Search</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($contents->count())
                                @foreach ($contents as $data)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="font-w600">{{ $data->title }}</td>
                                        <td>
                                            @if ($data->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="font-w600">{!! $data->order !!}</td>
                                        <td>
                                            <a href="{{ route('admin.sections.content.edit', ['id' => $sections->id, 'uuid' => $data->id]) }}"
                                                class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                title="Edit">Edit</a>

                                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="event.preventDefault(); if(confirm('Are you sure to delete this section?')){ document.getElementById('delete-data-{{ $data->id }}').submit();}">
                                                Delete
                                            </button>
                                            <form id="delete-data-{{ $data->id }}"
                                                action="{{ route('admin.sections.content.destroy', ['id' => $sections->id, 'uuid' => $data->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
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
            {{-- <div class="block-content">{{ $contents->links() }}</div> --}}
        </div>
    </div>
@endsection
@section('js_after')
    <script src="{{ URL::asset('assets/js/notify.js') }}"></script>
    <script>
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
