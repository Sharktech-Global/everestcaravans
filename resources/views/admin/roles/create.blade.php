@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Roles</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <a class="breadcrumb-item" href="{{ route('admin.roles.index') }}">Roles</a>
        <span class="breadcrumb-item active">Create</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add Role</h3>
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
            <form class="js-validation-role" action="{{ route('admin.roles.store') }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 @error('name') is-invalid @enderror">
                        <div class="form-material">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Please provide role name" value="{{ @old('name') }}" required>
                            <label for="name">Name <span class="text-danger">*</span></label>
                        </div>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('rolecategory') is-invalid @enderror">
                        <label class="col-12 p-0" for="rolecategory">Role Category <span class="text-danger">*</span></label>
                        <div class="col-md-12 p-0">
                            <select class="form-control" id="rolecategory" name="rolecategory" required>
                                <option value="">Please select</option>
                                <option value="admin">
                                    {{'admin'}}</option>
                                <option value="user">
                                    {{'user'}}</option>
                            </select>
                            @error('rolecategory')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row" id="permissions_div">
                    <div class="col-md-12 @error('name') is-invalid @enderror">
                        <div class="form-material">
                            <div class="row">
                                <div class="col-md-3 pt-2">
                                    <input type="checkbox" id="permission-all" class="role-checkbox"> All Permissions
                                </div>
                            </div>
                            @foreach($permissions->chunk(4) as $items)
                            <div class="row">
                                @foreach($items as $p)
                                    <div class="col-md-3 pt-2">
                                        <input type="checkbox" id="permission-{{ $p->id }}"  class="role-checkbox" name="permissions[]" value="{{ $p->id }}" required {{ (is_array(old('permissions')) && in_array($p->id, old('permissions'))) ? ' checked' : '' }}> {{$p->name}}<br>
                                    </div>
                                @endforeach
                            </div>
                            @endforeach
                            <label for="permissions">Permissions</label>
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

</div>
@endsection
@section('js_after')
<script>
    $('.js-validation-role').validate({
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
    $(document).ready(function() {
        $("#permission-all").change(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#rolecategory").change(function() {
            var selector = document.getElementById('rolecategory');
            var value = selector[selector.selectedIndex].value;
            if(value == 'admin') {
                $("#permissions_div").show();
            } else {
                $("#permissions_div").hide();
            }
        });
    });
</script>
@endsection
