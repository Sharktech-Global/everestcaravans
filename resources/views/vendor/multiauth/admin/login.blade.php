
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login | Everest Caravans</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f5f8;
            font-family: Arial, sans-serif;
            color: #1f2937;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 14px;
            padding: 38px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.08);
        }

        .login-heading {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-heading h1 {
            margin: 0 0 10px;
            font-size: 27px;
            font-weight: 700;
        }

        .login-heading p {
            margin: 0;
            font-size: 14px;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #2563eb;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .remember-row input {
            margin: 0;
        }

        .login-button {
            display: block;
            width: 100%;
            padding: 14px;
            background: #1f2937;
            color: #ffffff;
            border: 0;
            border-radius: 7px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .login-button:hover {
            background: #374151;
        }

        .forgot-link {
            display: block;
            margin-top: 22px;
            text-align: center;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
        }

        .error-message {
            margin-top: 7px;
            color: #dc2626;
            font-size: 13px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 26px 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-card">

        <div class="login-heading">
            <h1>Everest Caravans</h1>
            <p>Admin Login</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                    autofocus
                >

                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control"
                    autocomplete="current-password"
                    required
                >

                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <label class="remember-row">
                <input
                    type="checkbox"
                    name="remember"
                    {{ old('remember') ? 'checked' : '' }}
                >
                Remember Me
            </label>

            <button type="submit" class="login-button">
                Login
            </button>

            <a
                href="{{ route('admin.password.request') }}"
                class="forgot-link"
            >
                Forgot Your Password?
            </a>
        </form>

    </div>

</body>
</html>
