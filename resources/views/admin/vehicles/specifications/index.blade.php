@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Specifications</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
        <a class="breadcrumb-item" href="{{ route('vehicles.show',$vehicle->slug) }}"
            target="_blank">{{ $vehicle->name }}</a>
        <span class="breadcrumb-item active">Specifications</span>
    </nav>
    <form class="js-validation-vehicle-specifications"
        action="{{ route('admin.vehicles.specifications.store',$vehicle->id) }}" method="post">
        @csrf
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
        @foreach ($specifications as $specification)
        @php $value =
        @$vspecifications->where('specification_id',$specification->id)->where('specification_list_id',$list->id)->where('vehicle_grade_id',$grade->id)->first()->value;
        @endphp
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $specification->name }}</h3>
            </div>
            <div class="block-content">
                <div class="form-group row">
                    <div class="col-md-12 @error('details.{{$specification->id}}') is-invalid @enderror">
                        <div class="form-material">
                            <textarea class="form-control summernote" id="details-{{$specification->id}}"
                                name="details[{{ $specification->id }}]">{{ @old('details.$specification->id',$value) }}</textarea>
                            <label for="details-{{$specification->id}}">Details</label>
                        </div>
                        @error('details.{{$specification->id}}')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="block">
            <div class="block-content">
                <div class="row items-push-2x text-center text-sm-right">
                    <div class="col-sm-12 col-xl-12 mb-20">
                        <button type="submit" class="btn btn-primary min-width-125">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('js_after')
<script>
    $('.js-validation-vehicle-specifications').validate({
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
