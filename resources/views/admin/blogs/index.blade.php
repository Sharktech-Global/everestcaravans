@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Blogs</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Blogs</span>
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
            <form class="js-validation-vehicle-features" action="{{ route('admin.blogs.store') }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 @error('title') is-invalid @enderror">
                        <div class="form-material">
                            <input required type="text" class="form-control" value="{{ @old('title') }}" id="title" name="title" rows="2"
                                placeholder="Please provide title for the vehicle feature">
                            <label for="title">Title <span class="text-danger">*</span></label>
                        </div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('date') is-invalid @enderror">
                        <div class="form-material">
                            <input type="date" class="form-control" value="{{ @old('date') }}" id="date" name="date">
                            <label for="date">date</label>
                        </div>
                        @error('date')
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
                    <div class="col-md-6 @error('feature_image') is-invalid @enderror">
                        <div class="form-material">
                            <input type="file" id="feature_image" name="feature_image" multiple>
                            <label for="feature_image">Feature Image </label><br>
                            dimension(805 × 537px)<br>
                            width- 281, height- 188
                        </div>

                        @error('feature_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('status') is-invalid @enderror p-0">
                        <label class="col-12">Status</label>
                        <div class="col-12">
                            <div class="mb-5 custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" name="status" id="status1" value="1"
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
                             <!-- seo -->
                             <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Seo</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-md-6 @error('seo_title') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control"  id="seo_title" name="seo_title"
                                    value="{{ @old('seo_title') }}" placeholder="Please provide seo title "
                                        >
                                    <label for="seo_title">Seo Title</label>
                                </div>
                                @error('seo_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 @error('seo_keywords') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control"  id="seo_keywords" name="seo_keywords"
                                    value="{{ @old('seo_keywords') }}" placeholder="Please provide seo keywords "
                                        >
                                    <label for="seo_keywords">Seo Keywords</label>
                                </div>
                                @error('seo_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 @error('seo_description') is-invalid @enderror">
                                <div class="form-material">
                                    <input type="text" class="form-control"   id="seo_description" name="seo_description"
                                        value="{{ @old('seo_description') }}"
                                        placeholder="Please provide seo description " >
                                    <label for="seo_description">Seo Description</label>
                                </div>
                                @error('seo_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
                            <th>Date</th>
                            <th>Actions</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($blogs->count())
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="font-w600">{{ $blog->title }}</td>
                                    <td>
                                        @if ($blog->status == 1)
                                            <span>Active</span>
                                        @else
                                            <span>InActive</span>
                                        @endif
                                    </td>
                                    <td class="font-w600">{{date("j F Y", strtotime($blog->date_display) ) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.blogs.edit',$blog->id) }}"
                                                class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                title="Delete"
                                                onclick="event.preventDefault(); if(confirm('Are you sure to delete this blog?')){ document.getElementById('delete-row-{{ $blog->id }}').submit();}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <form id="delete-row-{{ $blog->id }}"
                                                method="POST" action="{{ route('admin.blogs.destroy',$blog->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $blog->updated_at->diffForHumans() }}</td>
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
        <div class="block-content">{{ $blogs->links() }}</div>
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