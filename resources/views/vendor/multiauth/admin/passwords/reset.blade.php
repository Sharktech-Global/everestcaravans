<!doctype html>
<html lang="en" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>

    <meta name="description" content="{{ config('app.name') }}">
    <meta name="author" content="Saran Sivaprasad">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.name') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">


    <!-- Stylesheets -->

    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ mix('css/theme.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="{{ mix('css/themes/flat.css') }}"> -->
    <!-- END Stylesheets -->
</head>

<body>

    <!-- Page Container -->

    <div id="page-container" class="main-content-boxed">

        <!-- Main Container -->
        <main id="main-container">

            <!-- Page Content -->
            <div class="bg-image" style="background-image: url('{{ asset('assets/images/slider/car-booking.jpg') }}');">
                <div class="row mx-0 bg-black-op">
                    <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                        <div class="p-30 invisible" data-toggle="appear">
                            <p class="font-size-h3 font-w600 text-white">
                                {{ config('app.name') }}
                            </p>
                            <p class="font-italic text-white-op">
                                Copyright &copy; <span class="js-year-copy">{{ date('Y') }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white">
                        <div class="content content-full">
                            <!-- Header -->
                            <div class="px-30 py-10">
                                <a class="link-effect font-w700" href="{{ route('admin.login') }}">
                                    <span class="font-size-xl text-primary-dark">{{ config('app.name') }}</span>
                                </a>
                                <h1 class="h3 font-w700 mt-30 mb-10">Reset Your Password</h1>
                                <h2 class="h5 font-w400 text-muted mb-0">Please add your new password</h2>
                            </div>
                            <!-- END Header -->

                            <!-- Sign Up Form -->
                            <form class="js-validation-signup px-30" action="{{ route('admin.password.request') }}"
                                method="post">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="email"
                                                class="form-control @if ($errors->has('email')) is-invalid  @endif"
                                                id="email" name="email" value="{{ $email ?? old('email') }}"
                                                autocomplete="email" autofocus>
                                            <label for="email">Email</label>
                                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="password"
                                                class="form-control @if ($errors->has('password')) is-invalid  @endif"
                                                id="password" name="password">
                                            <label for="password">Password</label>
                                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="password"
                                                class="form-control @if ($errors->has('password_confirmation')) is-invalid  @endif"
                                                id="password_confirmation" name="password_confirmation">
                                            <label for="password_confirmation">Password Confirmation</label>
                                            <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-hero btn-alt-success">
                                        <i class="fa fa-plus mr-10"></i> Reset Password
                                    </button>
                                    <div class="mt-30">
                                        <a class="link-effect text-muted mr-10 mb-5 d-inline-block"
                                            href="{{ route('admin.login') }}">
                                            <i class="fa fa-user text-muted mr-5"></i> Sign In
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign Up Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->


    <script src="{{ mix('js/theme.app.js') }}"></script>
    <script>
        $('.js-validation-signup').validate({
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
                        minlength: 8,
                        equalTo: '#password'
                    }
                },
                messages: {
                    email: 'Please enter a valid email address',
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

</body>

</html>
