@extends('admin.layouts.app')

@section('content')
    <div class="content">
        <h2 class="content-heading">Sub Network</h2>
        <nav class="bg-white breadcrumb push">
            <a class="breadcrumb-item" href="{{ route('admin.home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('admin.network_branch.index') }}">Network Branches</a>
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
                <form class="js-validation-categorytype" action="{{ route('admin.network_branch.update', $data->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6 @error('name') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="main_network" name="main_network" required>
                                    <option value="">Choose a network</option>
                                    @foreach ($main_networks as $main)
                                        <option @if ($data->main_id == $main->id) selected @endif value="{{ $main->id }}"  text="{{ $main->title }}">
                                            {{ $main->title }}</option>
                                    @endforeach
                                </select>
                                <label for="name">Main Network</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('sub_network') is-invalid @enderror">
                            <div class="form-material">
                                <select class="form-control" id="sub_network" name="sub_network" required>
                                    <option value="">Choose a sub network</option>
                                    @foreach ($sub_networks as $sub)
                                        <option @if ($data->sub_id == $sub->id) selected @endif value="{{ $sub->id }}">{{ $sub->sub_title }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="name">Sub Network</label>
                            </div>
                            @error('sub_network')
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
                        <div class="col-md-6 @error('branch_name') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="branch_name" name="branch_name"
                                    placeholder="Please provide a branch name" required
                                    value="{{ @old('branch_name', $data->branch_name) }}">
                                <label for="branch_name">Branch Name</label>
                            </div>
                            @error('branch_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('location') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="location" name="location"
                                    placeholder="Please provide a location"
                                    value="{{ @old('location', $data->location) }}">
                                <label for="location">Location</label>
                            </div>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('branch_head') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control" id="branch_head" name="branch_head"
                                    >{{ @old('branch_head', $data->branch_head) }}</textarea>
                                <label for="branch_head">Branch Head</label>
                            </div>
                            @error('branch_head')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('head_mobile') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="head_mobile" name="head_mobile"
                                    placeholder="Please provide mobile for head branch" value="{{ @old('head_mobile', $data->head_mobile) }}">
                                <label for="head_mobile">Mobile For Head Branch</label>
                            </div>
                            @error('head_mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('head_email') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="head_email" name="head_email"
                                    placeholder="Please provide email for head branch" value="{{ @old('head_email', $data->head_email) }}">
                                <label for="head_email">Email For Head Branch</label>
                            </div>
                            @error('head_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 @error('branch_address') is-invalid @enderror">
                            <div class="form-material">
                                <textarea class="form-control" id="branch_address" name="branch_address"
                                    required>{{ @old('branch_address', $data->branch_address) }}</textarea>
                                <label for="branch_address">Branch Address</label>
                            </div>
                            @error('branch_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 @error('address_mobile') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="address_mobile" name="address_mobile"
                                    placeholder="Please provide mobile for head branch" value="{{ @old('address_mobile', $data->address_mobile) }}">
                                <label for="address_mobile">Mobile For Branch Address</label>
                            </div>
                            @error('address_mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('address_email') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="address_email" name="address_email"
                                    placeholder="Please provide email for branch address" value="{{ @old('address_email', $data->address_email) }}">
                                <label for="address_email">Email For Branch Address</label>
                            </div>
                            @error('address_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-6 @error('link') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="link" name="link"
                                    placeholder="Please provide a website link"
                                    value="{{ @old('link', $data->website_link) }}">
                                <label for="link">Website Link</label>
                            </div>
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 @error('wm_name') is-invalid @enderror">
                            <div class="form-material">
                                <input class="form-control" type="text" id="wm_name" name="wm_name"
                                    placeholder="Please provide a wm name" value="{{ @old('wm_name', $data->wm_name) }}">
                                <label for="wm_name">WM Name</label>
                            </div>
                            @error('wm_name')
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
            $.ajax({
                    type: "GET",
                    url: "{{ route('admin.network_change') }}",
                    data: {
                        id : id
                    },
                    dataType: "json",
                    success: function(response){
                        $('#sub_network').empty();
                        console.log(response.data)
                        var formoption;
                        formoption = "<option value=''>Choose a sub network</option>";
                        $.each(response.data, function(v) {
                            formoption += "<option value='" + response.data[v].id + "'>" + response.data[v].sub_title + "</option>";
                        });
                        $('#sub_network').html(formoption);
                    }

                    });
                    if(val == 'SALES'){
                        $('#brandact').removeClass('d-none');
                    }else{
                        $('#brandact').addClass('d-none');
                        $('#brand option:selected').removeAttr('selected');
                    }

        });
    </script>
@endsection
