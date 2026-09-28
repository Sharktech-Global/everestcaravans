@extends('admin.layouts.app')

@section('css_after')

<link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}">
@endsection
@section('content')
<div class="content">
    <h2 class="content-heading">Contact</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Contact</span>
    </nav>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Add Contact</h3>
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
            <form class="js-validation-contact" action="{{ route('admin.contact.store') }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 @error('name') is-invalid @enderror">
                        <div class="form-material">
                            {{-- <div class="js-summernote">Hello Summernote!</div> --}}
                            <input type="text" class="form-control" placeholder="Please provide a contact name" name="name"required value="{{ @old('name') }}">
                            <label for="name">Name</label>
                        </div>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 @error('email') is-invalid @enderror">
                        <div class="form-material">
                            {{-- <div class="js-summernote">Hello Summernote!</div> --}}
                            <input type="email" class="form-control" placeholder="Please provide an email address" required name="email" value="{{ @old('email') }}">
                            <label for="email">Email</label>
                        </div>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>               
                <div class="form-group row">
                    <div class="col-md-6 @error('phone') is-invalid @enderror">
                        <div class="form-material">
                            {{-- <div class="js-summernote">Hello Summernote!</div> --}}
                            <input type="text" class="form-control" placeholder="Please provide phone number" required pattern="\+(?:[0-9] ?){6,14}[0-9]$" name="phone" value="{{ @old('phone') }}">
                            <label for="phone">Phone Number</label>
                        </div>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
            <h3 class="block-title">View Contacts</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($contact->count())
                        @foreach ($contact as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td >{{ $data->name }}</td>
                            <td >{{ $data->phone }}</td>
                            <td >{{ $data->email }}</td>
                            <td>
                                @if ($data->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.contact.edit',$data->id) }}"
                                        class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        title="Delete"
                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete this contact?')){ document.getElementById('delete-row-{{ $data->id }}').submit();}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="delete-row-{{ $data->id }}"
                                        action="{{ route('admin.contact.destroy', $data->id) }}" method="POST">
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
    </div>
</div>
@endsection
@section('js_after')
<script src="{{ asset('js/summernote-bs4.js') }}"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script>
<script>
    $('.js-validation-contact').validate({
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
                },
                messages: {
                name: {
                    pattern: "Please enter a name."
                },
                phone: {
                    pattern: "Please enter a valid phone number."
                },
                email: {
                    pattern: "Please enter a valid email."
                }
            }
    });
</script>
@endsection