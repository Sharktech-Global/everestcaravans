
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password | Everest Caravans Admin</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f5f9;
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #1f2937;
        }
        .auth-card {
            background: #fff;
            width: 100%;
            max-width: 420px;
            padding: 38px;
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(0,0,0,.08);
        }
        .brand { text-align: center; margin-bottom: 28px; }
        .brand h2 { margin: 0 0 8px; font-size: 24px; }
        .brand p { margin: 0; color: #6b7280; font-size: 14px; line-height: 1.6; }
        label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; }
        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 15px;
            outline: none;
        }
        input:focus { border-color: #2563eb; }
        button {
            width: 100%;
            margin-top: 20px;
            padding: 14px;
            background: #1e293b;
            color: #fff;
            border: 0;
            border-radius: 7px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover { background: #334155; }
        .back { text-align: center; margin-top: 22px; font-size: 14px; }
        .back a { color: #2563eb; text-decoration: none; }
        .alert { padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; }
        .success { background: #ecfdf5; color: #065f46; }
        .error { background: #fef2f2; color: #b91c1c; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="brand">
            <h2>Forgot Password?</h2>
            <p>Enter your admin email address and we'll send you a password reset link.</p>
        </div>

        @if (session('status'))
            <div class="alert success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}"
                   placeholder="Enter your admin email"
                   autocomplete="email" required autofocus>

            <button type="submit">Send Password Reset Link</button>
        </form>

        <div class="back">
            <a href="{{ route('admin.login') }}">Back to Admin Login</a>
        </div>
    </div>
</body>
</html>
