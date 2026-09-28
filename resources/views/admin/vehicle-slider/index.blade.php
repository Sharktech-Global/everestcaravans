@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Home Vehicle Slider</h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Home Vehicle Slider</span>
        </nav>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">View Home Vehicle Slider</h3>
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
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Logo</th>
                                {{-- <th>Thumb 1</th>
                                <th>Thumb 2</th> --}}
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sliders->count())
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td>
                                            {{-- $loop->iteration --}}
                                            {{ ($sliders ->currentpage()-1) * $sliders ->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="font-w600">{{ ucfirst($slider->type) }}</td>
                                        <td class="font-w600">
                                            @if ($slider->vehicle)
                                                <a href="/"
                                                    target="_blank">{{ $slider->vehicle->name }}</a>
                                            @else
                                                <a href="{{ $slider->explore }}" target="_blank">{{ $slider->name }}</a>
                                            @endif
                                        </td>
                                        <td class="font-w600"><img alt="Abreco" src="{{ asset('storage/' . $slider->image) }}"
                                                width="250px"></td>
                                        <td class="font-w600">{{ $slider->description }}</td>
                                        <td class="font-w600"><img alt="Abreco" src="{{ asset('storage/' . $slider->logo) }}"
                                                width="250px">
                                        </td>
                                        {{-- <td class="font-w600"><img alt="Abreco" src="{{ asset('storage/' . $slider->thumb1) }}"
                                                width="250px"></td>
                                        <td class="font-w600"><img alt="Abreco" src="{{ asset('storage/' . $slider->thumb2) }}"
                                                width="250px"></td> --}}
                                        <td>
                                            @if ($slider->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.vehicle-slider.edit', $slider->id) }}"
                                                    class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                    title="Delete"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete this slider?')){ document.getElementById('delete-data-{{ $slider->id }}').submit();}">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <form id="delete-data-{{ $slider->id }}"
                                                    action="{{ route('admin.vehicle-slider.destroy', $slider->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
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
            <div class="block-content">{{ $sliders->links() }}</div>
        </div>
    </div>
@endsection
@section('js_after')
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
    </script>
@endsection
