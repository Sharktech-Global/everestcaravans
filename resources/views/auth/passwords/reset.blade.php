
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | Everest Caravans Admin</title>
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
            width: 100%;
            max-width: 420px;
            padding: 38px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(0,0,0,.08);
        }
        h2 { margin: 0 0 8px; text-align: center; font-size: 24px; }
        .subtitle { text-align: center; color: #6b7280; font-size: 14px; margin-bottom: 28px; }
        .field { margin-bottom: 18px; }
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
        .back { margin-top: 22px; text-align: center; font-size: 14px; }
        .back a { color: #2563eb; text-decoration: none; }
        .alert { background: #fef2f2; color: #b91c1c; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2>Reset Password</h2>
        <p class="subtitle">Create a new password for your admin account.</p>

        @if ($errors->any())
            <div class="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ url('/admin/password/reset') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email"
                       value="{{ old('email', $email ?? request('email')) }}"
                       required autocomplete="email">
            </div>

            <div class="field">
                <label for="password">New Password</label>
                <input id="password" type="password" name="password"
                       required autocomplete="new-password">
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password"
                       name="password_confirmation"
                       required autocomplete="new-password">
            </div>

            <button type="submit">Reset Password</button>
        </form>

        <div class="back">
            <a href="{{ route('admin.login') }}">Back to Admin Login</a>
        </div>
    </div>
</body>
</html>
