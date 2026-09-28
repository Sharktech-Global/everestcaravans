@extends('admin.layouts.app')

@section('content')
<div class="content">
    <h2 class="content-heading">Exchanges</h2>
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Exchanges</span>
    </nav>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">View Exchanges</h3>
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
            <div class="float-right mb-3">
                <form class="form-inline" action="" method="get" style="display:block;">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" name="search"
                        value="{{ @$search }}">
                    <button type="submit" class="btn btn-alt-primary">Search</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Model</th>
                            <th>Condition</th>
                            <th>Color</th>
                            <th>Emission</th>
                            <th>Name</th>
                            <th>Email</th>.
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Created</th>
                            <th>show</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($enquiries->count())
                        @foreach ($enquiries as $data)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td class="font-w600">{{ @$data->model }}</td>
                            <td class="font-w600">{{ @$data->condition->name }}</td>
                            <td class="font-w600">{{ @$data->color }}</td>
                            <td class="font-w600">{{ @$data->emission->name }}</td>
                            <td class="font-w600">{{ @$data->name }}</td>
                            <td class="font-w600">{{ @$data->email }}</td>
                            <td class="font-w600">{{ @$data->phone }}</td>
                            <td class="font-w600">{{ @$data->location->name }}</td>
                            <td>{{ $data->created_at->format('d-m-Y h:i A') }}</td>
                            <td><a href="{{route('admin.exchanges.show',$data->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> Show</a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="no-data">
                            <td colspan="10" class="text-center">No data available in table</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
        <div class="block-content">{{ $enquiries->links() }}</div>
    </div>
</div>
@endsection
@section('js_after')
<script>
    @if (session('error'))
    swal.fire({
        title: "Oh No!",
        text: "{{ session('error') }}",
        icon: 'error',
        timer: 3000,
        showCancelButton: false,
        showConfirmButton: false
    });
    @endif
    @if (session('success'))
        swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: 'success',
            timer: 3000,
            showCancelButton: false,
            showConfirmButton: false
        });
    @endif
</script>
@endsection
