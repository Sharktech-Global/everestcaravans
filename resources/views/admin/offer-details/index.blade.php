@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Offer Details</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Offer Details</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add Offer</h3>
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
            <form class="js-validation-offer-details" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 @error('state') is-invalid @enderror">
                        <div class="form-material">
                            <select class="form-control @error('state') is-invalid @enderror state" id="state" name="state" required>
                                @foreach ($states as $state)
                                <option value="{{ $state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                            <label for="state">State</label>
                        </div>
                        @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('model') is-invalid @enderror">
                        <div class="form-material">
                            <input class="form-control" type="text" id="model" name="model"  placeholder="Please provide model"
                                required value="">
                            <label for="model">Model</label>
                        </div>
                        @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 @error('offer') is-invalid @enderror">
                        <div class="form-material">
                            <input class="form-control" type="text" id="offer" name="offer"  placeholder="Please provide offer"
                                required value="">
                            <label for="offer">Offer</label>
                        </div>
                        @error('offer')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-alt-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Offers</h3>
        </div>
        <div class="block-content">
            <div class="float-right mb-3">
                <form class="form-inline" action="" method="get" style="display:block;">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" name="search"
                        value="{{ @$search }}">
                    <button type="submit" class="btn btn-alt-primary">Search</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Vehicle</th>
                            <th>Offer</th>
                            <th>Actions</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($offers->count())
                        @foreach ($offers as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="font-w600">{{ $data->model }}</td>
                            <td class="font-w600">{{ $data->offer }}</td>
                            <td>
                                <div class="btn-group">
                                    @if ($data->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                    <a href="{{ route('admin.offer_details.edit',$data->id) }}"
                                        class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        title="Delete"
                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete this message ?')){ document.getElementById('delete-row-{{ $data->id }}').submit();}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="delete-row-{{ $data->id }}"
                                        action="{{ route('admin.offer_details.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                            <td>{{ $data->updated_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="8" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        <div class="block-content">{{ $offers->links() }}</div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    $('.js-validation-offer-details').validate({
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
