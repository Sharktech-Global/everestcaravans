@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Brands</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.network_main.store') }}">Dashboard</a>
            <span class="breadcrumb-item active">Brands</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Brand</h3>
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
                <form class="js-validation-Category-Types" action="{{ route('admin.brands.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Please provide name for brand" required value="">
                                <label for="name">Name</label>
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
                <h3 class="block-title">View brands</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <div id="picoutput1" class="alert alert-success d-none clear"></div>
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
                            @if ($brands->count())
                                @foreach ($brands as $data)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="font-w600">{{$data->brand }}</td>

                                        <td>
                                            <div class="btn-group">
                                                {{-- <a href="{{ route('admin.network_main.edit', $data->id) }}"
                                                    class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                --}}<button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                    title="Delete"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete this brand ?')){ document.getElementById('delete-row-{{ $data->id }}').submit();}">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <form id="delete-row-{{ $data->id }}"
                                                    action="{{ route('admin.brand.destroy', $data->id) }}"
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
        $('.js-validation-Category-Types').validate({
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
