@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Documents</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Documents</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Documents</h3>
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
                <form class="js-validation-documents" action="{{ route('admin.documents.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Please provide vehicle type" value="{{ @old('name') }}" required>
                                <label for="name">Name</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 @error('document') is-invalid @enderror">
                            <div class="form-material">
                                <input type="file" id="document" name="document" required>
                                <label for="document">Document</label>
                            </div>
                            @error('document')
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
                <h3 class="block-title">View Documents</h3>
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
                            @if ($documents->count())
                                @foreach ($documents as $data)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="font-w600">{{ $data->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                    title="Delete"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete this document?')){ document.getElementById('delete-row-{{ $data->id }}').submit();}">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <form id="delete-row-{{ $data->id }}"
                                                    action="{{ route('admin.documents.destroy', $data->id) }}"
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
            <div class="block-content">{{ $documents->links() }}</div>
        </div>
    </div>
@endsection
@section('js_after')
    <script>
        $('.js-validation-documents').validate({
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
