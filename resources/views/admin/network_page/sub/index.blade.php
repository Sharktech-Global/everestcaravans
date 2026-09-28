@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Category</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.network_sub.store') }}">Dashboard</a>
            <span class="breadcrumb-item active">Sub Network</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add Sub Network</h3>
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
                <form class="js-validation-Category-Types" action="{{ route('admin.network_sub.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 @error('main_network') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" name="main_network"id="main_network" required>
                                    <option value="">Choose a network</option>
                                    @foreach ($networks as $network)
                                        <option value="{{ $network->id }}" text="{{ $network->title }}">{{ $network->title }}</option>
                                    @endforeach
                                </select>
                                <label for="main_network">Main Network</label>
                            </div>
                            @error('main_network')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row d-none" id="brandact">
                        <div class="col-md-6 ">
                            <div class="form-material">
                                <select class="form-control" id="brand" name="brand" >
                                    <option value="">Choose a brand</option>
                                    @foreach ($brands as $data)
                                        <option value="{{ $data->id }}">{{ $data->brand }}</option>
                                    @endforeach
                                </select>
                                <label for="name">Brand</label>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Please provide name for sub network" required value="">
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
                <h3 class="block-title">View Sub Networks</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>Sl.No.</th>
                                <th>Main Network</th>
                                <th>Sub Network</th>
                                <th>Actions</th>
                                <th>Last Modified</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($datas->count())
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>
                                            {{ ($datas->currentpage() - 1) * $datas->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td class="font-w600">{{ $data->main->title }}</td>
                                        <td class="font-w600">{{ $data->sub_title }}</td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.network_sub.edit', $data->id) }}"
                                                    class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Edit"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                    title="Delete"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete this sub network ?')){ document.getElementById('delete-row-{{ $data->id }}').submit();}">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <form id="delete-row-{{ $data->id }}"
                                                    action="{{ route('admin.network_sub.destroy', $data->id) }}"
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
            <div class="block-content">{{ $datas->links() }}</div>
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
        $('#main_network').on('change', function() {
            var id=this.value;
            var val = $('option:selected', this).attr('text');
            if(val == 'SALES'){
                        $('#brandact').removeClass('d-none');
                    }else{
                        $('#brandact').addClass('d-none');
                        $('#brand option:selected').removeAttr('selected');
                    }
        });
    </script>
@endsection
