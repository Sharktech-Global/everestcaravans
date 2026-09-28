@extends('admin.layouts.app')

@section('content')
<!-- User Info -->
<div class="bg-image bg-image-bottom"
    style="background-image: url('{{ asset('storage/media/photos/profile_bg.jpg') }}');">
    <div class="bg-primary-dark-op py-30">
        <div class="content content-full text-center">
            <!-- Avatar -->
            <div class="mb-15">
                <a class="img-link" href="javascript::void(0)">
                    <img class="img-avatar img-avatar96 img-avatar-thumb"
                        src="{{ Avatar::create(Auth::user()->name)->toBase64() }}"  alt="Abreco">
                </a>
            </div>
            <!-- END Avatar -->

            <!-- Personal -->
            <h1 class="h3 text-white font-w700 mb-10">{{ Auth::user()->name }}</h1>
            <h2 class="h5 text-white-op">
                {{ Auth::user()->role }}
            </h2>
            <!-- END Personal -->
        </div>
    </div>
</div>
<!-- END User Info -->

<!-- Main Content -->
<div class="content">
    <div class="row items-push">
        {{-- <div class="col-md-6 col-xl-6">
            <!-- Activity -->
            <h2 class="content-heading">
                <i class="si si-list mr-5"></i> Activity
            </h2>
            <div class="row items-push">
                <div class="col-md-12 col-xl-12">
                    <div class="block">
                        <div class="block-content block-content-full">
                            <ul class="list list-timeline list-timeline-modern pull-t">
                                @foreach ($activities as $activity)
                                <li>
                                    <div class="list-timeline-time">{{ $activity->updated_at->diffForHumans() }}</div>
                                    <i class="list-timeline-icon fa fa-list bg-info"></i>
                                    <div class="list-timeline-content">
                                        <p class="font-w600">{{ $activity->description }}</p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="block-content">
                            {{ $activities->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Activity -->
        </div> --}}
        <div class="col-md-6 col-xl-6">
            <!-- Activity -->
            <h2 class="content-heading">
                <i class="si si-user mr-5"></i> Update Profile
            </h2>
            <div class="row items-push">
                <div class="col-md-12">
                    <!-- Floating Labels -->
                    <div class="block">
                        <div class="block-content">
                            <form action="{{ route('admin.profile') }}" method="post" class="js-validation-profile">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-material floating">
                                            <input type="text"
                                                class="form-control @if ($errors->has('name')) is-invalid  @endif"
                                                id="name" name="name" value="{{ @old('name',$user->name) }}">
                                            <label for="name">Name</label>
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="email"
                                                class="form-control @if ($errors->has('email')) is-invalid  @endif"
                                                id="email" name="email" value="{{ @old('email',$user->email) }}">
                                            <label for="email">Email</label>
                                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-material floating">
                                            <input type="password"
                                                class="form-control @if ($errors->has('password')) is-invalid  @endif"
                                                id="password" name="password">
                                            <label for="password">Password</label>
                                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-material floating">
                                            <input type="password"
                                                class="form-control @if ($errors->has('password_confirmation')) is-invalid  @endif"
                                                id="password_confirmation" name="password_confirmation">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-alt-primary">Submit</button>
                                    </div>
                                </div>
                                @if (session('success'))
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="alert alert-success">{{ session('success') }} </div>
                                    </div>
                                </div>
                                @endif
                                @if (session('error'))
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="alert alert-danger">{{ session('error') }} </div>
                                    </div>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <!-- END Floating Labels -->
                </div>
            </div>
            <!-- Activity -->
        </div>
    </div>



</div>
<!-- END Main Content -->

@endsection
@section('js_after')
<script>
    $('.js-validation-profile').validate({
        ignore: [],
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        errorPlacement: (error, e) => {
            $(e).parents('.form-group > div').append(error);
        },
        highlight: e => {
            $(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
        },
        success: e => {
            $(e).closest('.form-group').removeClass('is-invalid');
            $(e).remove();
        },
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            name: {
                required: 'Please enter your name',
                minlength: 'Your username must consist of at least 3 characters'
            },
            name: {
                required: 'Please enter your email address',
                email: 'Please enter a valid email address',
            },
            password: {
                required: 'Please provide a password',
                minlength: 'Your password must be at least 8 characters long'
            },
            password_confirmation: {
                required: 'Please provide a password',
                minlength: 'Your password must be at least 8 characters long',
                equalTo: 'Please enter the same password as above'
            }
        }
    });
</script>
@endsection
