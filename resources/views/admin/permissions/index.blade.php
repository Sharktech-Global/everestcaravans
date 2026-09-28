@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Permissions</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Permissions</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add Permission</h3>
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
            <form class="js-validation-permissions" action="{{ route('admin.permissions.store') }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 @error('name') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Please provide permission" value="{{ @old('name') }}" required>
                            <label for="name">Name <span class="text-danger">*</span></label>
                        </div>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
            <h3 class="block-title">View Permissions</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Name</th>
                            <th>Actions</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($permissions->count())
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>
                            {{ ($permissions ->currentpage()-1) * $permissions ->perpage() + $loop->index + 1 }}
                            </td>
                            <td class="font-w600">{{ $permission->name }}</td>
                            <td>
                                <div class="btn-group">
                                    <button permission="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        title="Delete"
                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete this permission?')){ document.getElementById('delete-permission-{{ $permission->id }}').submit();}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="delete-permission-{{ $permission->id }}"
                                        action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                            <td>{{ $permission->updated_at->diffForHumans() }}</td>
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
        <div class="block-content">{{ $permissions->links() }}</div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    $('.js-validation-permissions').validate({
        errorClass: 'invalid-feedback',
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