@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">FAQ</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>

        <a class="breadcrumb-item" href="#"
            target="_blank">{{ $vehicle->name }}</a>
        <span class="breadcrumb-item active">FAQ</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View FAQ</h3>
            <a href="{{ route('admin.vehicles.faq.create',$vehicle->id) }}"
                class="btn btn-primary min-width-125">Add
                FAQ</a>
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(@$faqs)
                        @foreach ($faqs as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="font-w600">{{ $data->title }}</td>
                            <td class="font-w600">{!! $data->description !!}</td>
                            <td>{{ $data->order }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.vehicles.faq.edit',[$vehicle->id,$data->id]) }}"
                                        class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        title="Delete"
                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete this faq?')){ document.getElementById('delete-data-{{ $data->id }}').submit();}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="delete-data-{{ $data->id }}"
                                        action="{{ route('admin.vehicles.faq.destroy',[$vehicle->id,$data->id]) }}"
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
                            <td colspan="5" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        <div class="block-content">{{ $faqs->links() }}</div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    $('.js-validation-vehicles').validate({
        ignore: "",
        errorClass: 'invalid-feedback animated fadeInDown',
                errorElement: 'div',
                errorPlacement: (error, e) => {
                    $(e).parents('.form-group > div').append(error);
                },
                highlight: e => {
                    $(e).closest('.form-group > div').removeClass('is-invalid').addClass('is-invalid');
                },
                success: e => {
                    $(e).closest('.form-group > div').removeClass('is-invalid');
                    $(e).remove();
                }
    });
</script>
@endsection
