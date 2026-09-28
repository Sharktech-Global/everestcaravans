@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Features</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
        {{--  <a class="breadcrumb-item" href="{{ route('admin.vehicles.show',$vehicle->id) }}"
            target="_blank">{{ $vehicle->name }}</a>  --}}
        <span class="breadcrumb-item active">Features</span>
    </nav>
    <div class="block">
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
            <form class="js-validation-vehicle-features" action="{{ route('admin.vehicles.features.store',$vehicle->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 @error('title') is-invalid @enderror">
                        <div class="form-material">
                            <input required type="text" class="form-control" value="{{ @old('title') }}" id="title" name="title" rows="2"
                                placeholder="Please provide title for the vehicle feature">
                            <label for="title">Title <span class="text-danger">*</span></label>
                        </div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('subtitle') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" value="{{ @old('subtitle') }}" id="subtitle" name="subtitle" rows="2"
                                placeholder="Please provide subtitle for the vehicle feature">
                            <label for="subtitle">Subtitle</label>
                        </div>
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('details') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="details" name="details" rows="2"
                                placeholder="Please provide details for the vehicle">{{ @old('details') }}</textarea>
                            <label for="details">Details</label>
                        </div>
                        @error('details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 @error('images') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="images" name="images[]"  multiple>
                            <label for="images">Images </span></label>
                        </div>
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="block-content">
                    <div class="row items-push-2x text-center text-sm-right">
                        <div class="col-sm-12 col-xl-12 mb-20">
                            <button type="submit" class="btn btn-primary min-width-125">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Vehicle Types</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Actions</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($features->count())
                            @foreach ($features as $feature)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="font-w600">{{ $feature->title }}</td>
                                    <td class="font-w600">{{ $feature->subtitle }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.vehicles.features.edit',[$feature->vehicle_id,$feature->id]) }}"
                                                class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="event.preventDefault(); if(confirm('Are you sure to delete this vehicle feature?')){ document.getElementById('delete-row-{{ $feature->id }}').submit();}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <form id="delete-row-{{ $feature->id }}"
                                                method="POST" action="{{ route('admin.vehicles.features.destroy',[$feature->vehicle_id,$feature->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $feature->updated_at->diffForHumans() }}</td>
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
        <div class="block-content">{{ $features->links() }}</div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    $('.js-validation-vehicle-features').validate({
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