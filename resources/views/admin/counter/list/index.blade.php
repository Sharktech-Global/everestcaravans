@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">List</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">List</span>
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
            <form class="js-validation-vehicle-features" action="{{ route('admin.counter-settings-list.store') }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 @error('title') is-invalid @enderror">
                        <div class="form-material">
                            <input required type="text" class="form-control" value="{{ @old('title') }}" id="title" name="title" rows="2"
                                placeholder="Please provide title for the list">
                            <label for="title">Title <span class="text-danger">*</span></label>
                        </div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('counter') is-invalid @enderror">
                        <div class="form-material">
                            <input required type="text" class="form-control" value="{{ @old('counter') }}" id="counter" name="counter" rows="2"
                                placeholder="Please provide counter for the list">
                            <label for="counter">Counter <span class="text-danger">*</span></label>
                        </div>
                        @error('counter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('order_by') is-invalid @enderror">
                        <div class="form-material">
                            <input required type="number" class="form-control" value="{{ @old('order_by') }}" id="order_by" name="order_by" rows="2"
                                placeholder="Please provide order for list">
                            <label for="order_by">Order <span class="text-danger">*</span></label>
                        </div>
                        @error('order_by')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 @error('plus') is-invalid @enderror">
                        <div class="form-material">
                            <input  type="text" class="form-control" value="{{ @old('plus') }}" id="plus" name="plus" rows="2"
                                placeholder="Please provide add on to list">
                            <label for="plus">Add on</label>
                        </div>
                        @error('plus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mt-3 @error('status') is-invalid @enderror p-0">
                        <label class="col-12">Status <span class="text-danger">*</span></label>
                        <div class="col-12">
                            <div class="mb-5 custom-control custom-radio custom-control-inline">
                                <input  class="custom-control-input" type="radio" name="status" id="status1" value="1"
                                    @if (!@old('status')) checked @endif>
                                <label class="custom-control-label" for="status1">Yes</label>
                            </div>
                            <div class="mb-5 custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" name="status" id="status2" value="0"
                                    @if (@old('status')) checked @endif>
                                <label class="custom-control-label" for="status2">No</label>
                            </div>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
            <h3 class="block-title">View Blogs</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Counter</th>
                            <th>Actions</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($lists->count())
                            @foreach ($lists as $list)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="font-w600">{{ $list->title }}</td>
                                    <td>
                                        @if ($list->status == 1)
                                            <span>Active</span>
                                        @else
                                            <span>InActive</span>
                                        @endif
                                    </td>
                                    <td class="font-w600">{{$list->counter}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.counter-settings-list.edit',$list->id) }}"
                                                class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="event.preventDefault(); if(confirm('Are you sure to delete this list?')){ document.getElementById('delete-row-{{ $list->id }}').submit();}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <form id="delete-row-{{ $list->id }}"
                                                method="POST" action="{{ route('admin.counter-settings-list.destroy',$list->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $list->updated_at->diffForHumans() }}</td>
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
        <div class="block-content">{{ $lists->links() }}</div>
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