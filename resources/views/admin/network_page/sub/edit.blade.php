@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Sub Network</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.network_sub.index') }}">Sub Network</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Sub Network</h3>
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
                <form class="js-validation-categorytype" action="{{ route('admin.network_sub.update', $data->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12 @error('namain_networkme') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" name="main_network"  id='main_network'required>
                                    <option value="">Choose a network</option>
                                    @foreach ($networks as $network)
                                        <option @if ($data->main_id == $network->id) selected @endif value="{{ $network->id }}">
                                            {{ $network->title }}</option>
                                    @endforeach
                                </select>
                                <label for="main_network">Main Network</label>
                            </div>
                            @error('main_network')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row @if ($data->main->title !== 'SALES') d-none @endif " id="brandact">
                        <div class="col-md-6 ">
                            <div class="form-material">
                                <select class="form-control" id="brand" name="brand" >
                                    <option value="">Choose a brand</option>
                                   @foreach ($brands as $sub)
                                   <option @if ($sub->id == @$data->brand->id ) selected @endif  value="{{ @$sub->id }}">{{ @$sub->brand }}
                                   </option>
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
                                    placeholder="Please provide name for category type" required
                                    value="{{ @old('name', $data->sub_title) }}">
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
    </div>
@endsection
@section('js_after')
    <script>
        $('.js-validation-categorytype').validate({
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
