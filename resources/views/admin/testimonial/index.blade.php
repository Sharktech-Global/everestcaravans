@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Testimonial</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Testimonial</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Testimonial</h3>
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
                <form class="js-validation-testimonials" action="{{ route('admin.testimonials.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Please provide name" required value="{{ @old('name') }}">
                                <label for="name">Name</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('designation') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="designation" name="designation"
                                    placeholder="Please provide designation" value="{{ @old('designation') }}">
                                <label for="designation">Designation</label>
                            </div>
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('title') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="title" name="title"
                                    placeholder="Please provide title" value="{{ @old('title') }}">
                                <label for="title">Title</label>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('rating') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="number" id="rating" name="rating"
                                    placeholder="Please provide rating" value="{{ @old('rating') }}">
                                <label for="rating">Rating</label>
                            </div>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('message') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="message"
                                    name="message">{{ @old('message') }}</textarea>
                                <label for="message">Message</label>
                            </div>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('content') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control summernote" id="content"
                                    name="content">{{ @old('content') }}</textarea>
                                <label for="content">Content</label>
                            </div>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('photo') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="photo" name="photo">
                                <label for="photo">Image</label>
                            </div>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('url') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="url" name="url"
                                    placeholder="Please provide video url" value="{{ @old('url') }}">
                                <label for="url">Video URL <small>Embed Video Link</small></label>
                            </div>
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="form-group row">

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
                <h3 class="block-title">View Testimonials</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>Sl.No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Rating</th>
                                <th>Actions</th>
                                <th>Last Modified</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($testimonials->count())
                                @foreach ($testimonials as $data)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="font-w600">
                                            @if ($data->photo)
                                                <img alt="Abreco" class="pt-65" style="width: 50px;"
                                                    src="{{ asset('storage/' . $data->photo) }}">
                                            @endif
                                        </td>
                                        <td class="font-w600">{{ $data->name }}</td>
                                        <td class="font-w600">{{ $data->designation }}</td>
                                        <td class="font-w600">{{ $data->message }}</td>
                                        <td class="font-w600">{{ $data->rating }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.testimonials.edit', $data->id) }}"
                                                    class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                    title="Delete"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete this message ?')){ document.getElementById('delete-row-{{ $data->id }}').submit();}">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <form id="delete-row-{{ $data->id }}"
                                                    action="{{ route('admin.testimonials.destroy', $data->id) }}"
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
                                    <td colspan="8" class="text-center">No data available in table</td>
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
        $('.js-validation-testimonials').validate({
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
