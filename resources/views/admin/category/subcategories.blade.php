@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Sub Categories of {{ @$category->name }} </h2>
        <nav class="breadcrumb bg-white push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.category_type.index') }}">{{ @$category_type->name }}</a>
            <a class="breadcrumb-item"
                href="{{ route('admin.category.index', [@$category_type->id]) }}">{{ @$category->name }}</a>
            <span class="breadcrumb-item active">Sub Categories of {{ @$category->name }} </span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Sub Category to {{ @$category->name }}</h3>
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
                <form class="js-validation-subCategory"
                    action="{{ route('admin.subcategory.store', [@$category_type->id, $category->id]) }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Please provide name for category type" required value="">
                                <label for="name">Name</label>
                            </div>
                            @error('name')
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
                        <div class="col-md-6 @error('is_similar') is-invalid @enderror p-0">
                            <label class="col-12">Similar</label>
                            <div class="col-12">
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" name="is_similar" id="is_similar1"
                                        value="1" @if (@old('is_similar')) checked @endif>
                                    <label class="custom-control-label" for="is_similar1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mb-5">
                                    <input class="custom-control-input" type="radio" name="is_similar" id="is_similar2"
                                        value="0" @if (!@old('is_similar')) checked @endif>
                                    <label class="custom-control-label" for="is_similar2">No</label>
                                </div>
                                @error('is_similar')
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
                <h3 class="block-title">View Sub Categories of {{ @$category->name }}</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>Sl.No.</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Similar</th>
                                <th>Actions</th>
                                <th>Last Modified</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($subcat->count())
                                @foreach ($subcat as $data)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="font-w600">{{ @$data->name }}</td>
                                        <td>
                                            @if ($data->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->is_similar == '1')
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                {{-- <a href="{{ route('admin.subcategory.index',[@$category_type->id,$data->id]) }}"
                                        class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit">Sub Categories</a> --}}
                                                <a href="{{ route('admin.subcategory.edit', [@$category_type->id, @$category->id, $data->id]) }}"
                                                    class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                    title="Delete"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete this sub category  ?')){ document.getElementById('delete-row-{{ $data->id }}').submit();}">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <form id="delete-row-{{ $data->id }}"
                                                    action="{{ route('admin.subcategory.destroy', [@$category_type->id, @$category->id, $data->id]) }}"
                                                    method="POST">
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
                                    <td colspan="5" class="text-center">No data available in table</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
            {{-- <div class="block-content">{{ $announcements->links() }}</div> --}}
        </div>
    </div>
@endsection
@section('js_after')
    <script>
        $('.js-validation-subCategory').validate({
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
