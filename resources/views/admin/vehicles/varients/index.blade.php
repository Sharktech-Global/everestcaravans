@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Vehicles</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
        {{-- <a class="breadcrumb-item" href="{{ route('vehicles.show',$vehicle->slug) }}"
            target="_blank">{{ $vehicle->name }}</a> --}}
        <span class="breadcrumb-item active">Variants</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add Varient</h3>
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
            <form class="js-validation-vehicle-varients"
                action="{{ route('admin.vehicles.varients.store',$vehicle->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-4 @error('name') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Please provide name of vehicle variant" value="{{ @old('name') }}"
                                required>
                            <label for="name">Name</label>
                        </div>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('fuel') is-invalid @enderror">
                        <div class="form-material">
                            <select class="form-control" id="fuel" name="fuel" required>
                                <option></option>
                                @foreach ($fuels as $fuel)
                                <option value="{{ $fuel->id }}" {{ (old('fuel') == $fuel->id) ? 'selected':'' }}>
                                    {{ $fuel->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="fuel">Fuel Type</label>
                        </div>
                        @error('fuel')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('transmission') is-invalid @enderror">
                        <div class="form-material">
                            <select class="form-control" id="transmission" name="transmission" required>
                                <option></option>
                                @foreach ($transmissions as $transmission)
                                <option value="{{ $transmission->id }}"
                                    {{ (old('transmission') == $transmission->id) ? 'selected':'' }}>
                                    {{ $transmission->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="transmission">Transmission Type</label>
                        </div>
                        @error('transmission')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('status') is-invalid @enderror p-0">
                        <label class="col-12">Status</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status1" value="1" @if (!@old('status')) checked @endif>
                                <label class="custom-control-label" for="status1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="0" @if (@old('status')) checked @endif>
                                <label class="custom-control-label" for="status2">No</label>
                            </div>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-alt-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Variants</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Fuel Type</th>
                            <th>Transmission Type</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($varients->count())
                        @foreach ($varients as $data)
                        <tr>
                            <td class="font-w600">{{ $data->name }}</td>
                            <td>{{ $data->fuel->name }}</td>
                            <td>{{ $data->transmission->name }} </td>
                            <td>
                                @if ($data->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.vehicles.varients.edit',[$vehicle->id,$data->id]) }}"
                                        class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        title="Delete"
                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete this vehicle variant?')){ document.getElementById('delete-data-{{ $data->id }}').submit();}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="delete-data-{{ $data->id }}"
                                        action="{{ route('admin.vehicles.varients.destroy',[$vehicle->id,$data->id]) }}"
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
                            <td colspan="4" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        <div class="block-content">{{ $varients->links() }}</div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    $(document).ready(function() {
        $('#fuel').select2({
            placeholder: 'Please select a fuel type',
            width: '100%',
            allowClear:true
        });
        $('#transmission').select2({
            placeholder: 'Please select a transmission type',
            width: '100%',
            allowClear:true
        });
        $('#grade').select2({
            placeholder: 'Please select a vehicle grade',
            width: '100%',
            allowClear:true
        });
    });
    $('.js-validation-vehicle-varients').validate({
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
