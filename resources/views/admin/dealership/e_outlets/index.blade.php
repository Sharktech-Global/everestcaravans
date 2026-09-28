@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Dealership</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.dealership.index') }}">Dealership</a>
        <a class="breadcrumb-item" href="{{ route('admin.dealership.show',$dealership->id) }}"
            target="_blank">{{ $dealership->name }}</a>
        <span class="breadcrumb-item active">E-Outlets</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add E-Outlet</h3>
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
            <form class="js-validation-dealership.e_outlet"
                action="{{ route('admin.dealership.e_outlet.store',$dealership->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-4 @error('spc_name') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="spc_name" name="spc_name"
                                placeholder="Please provide spc name" value="{{ @old('spc_name') }}"
                                required>
                            <label for="spc_name">SPC Name</label>
                        </div>
                        @error('spc_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('spc_head') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="spc_head" name="spc_head"
                                placeholder="Please provide spc head" value="{{ @old('spc_head') }}"
                                required>
                            <label for="spc_head">SPC Head</label>
                        </div>
                        @error('spc_head')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('spc_phone') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="spc_phone" name="spc_phone"
                                placeholder="Please provide spc phone" value="{{ @old('spc_phone') }}"
                                required>
                            <label for="spc_phone">SPC Phone</label>
                        </div>
                        @error('spc_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('spc_email') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="spc_email" name="spc_email"
                                placeholder="Please provide spc email" value="{{ @old('spc_email') }}"
                                required>
                            <label for="spc_email">SPC Email</label>
                        </div>
                        @error('spc_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 @error('spc_address') is-invalid @enderror">
                        <div class="form-material">
                            <textarea name="spc_address" class="form-control" required></textarea>
                            <label for="spc_address">SPC Address</label>
                        </div>
                        @error('spc_address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 @error('status') is-invalid @enderror p-0">
                        <label class="col-12">Status</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                    @if (@old('status')) checked @endif>
                                <label class="custom-control-label" for="status1">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-5">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                    @if (!@old('status')) checked @endif>
                                <label class="custom-control-label" for="status2">Inactive</label>
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
            <h3 class="block-title">View E-Outlets</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Head</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($e_outlets->count())
                        @foreach ($e_outlets as $data)
                        <tr>
                            <td class="font-w600">{{ $data->spc_name }}</td>
                            <td>{{ $data->spc_head }}</td>
                            <td>{{ $data->spc_head_phone }}</td>
                            <td>{{ $data->spc_head_email }}</td>
                            <td>{{ $data->address }}</td>
                            <td class="font-w600">
                                @if ($data->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.dealership.e_outlet.edit',[$dealership->id,$data->id]) }}"
                                        class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        title="Delete"
                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete this e-outlet?')){ document.getElementById('delete-data-{{ $data->id }}').submit();}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="delete-data-{{ $data->id }}"
                                        action="{{ route('admin.dealership.e_outlet.destroy',[$dealership->id,$data->id]) }}"
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
                            <td colspan="7" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        <div class="block-content">{{ $e_outlets->links() }}</div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    $(document).ready(function() {
        $('.js-validation-dealership.e_outlet').validate({
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
    });
    
</script>
@endsection
