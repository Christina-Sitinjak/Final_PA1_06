<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            background: linear-gradient(to right, #C7D3D4FF, #b6895b);
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 30%;
            backdrop-filter: blur(10px);
            text-align: center;
        }

        h1 {
            color: #fff;
            margin-bottom: 20px;
            border-bottom: 3px solid white;
            display: inline-block;
            padding-bottom: 5px;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button {
            width: 60%;
            padding: 12px;
            border: none;
            border-radius: 25px;
            background: black;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
        }

        .button:hover {
            background: #b6895b;
            color: black;
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
        }

        .register-text {
            color: white;
            margin-top: 10px;
            font-size: 14px;
        }

        .register-text a {
            color: yellow;
            text-decoration: none;
            font-weight: bold;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('logins') }}" onsubmit="return validateForm()">
            @csrf
            <input type="email" class="input-field" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" class="input-field" id="password" name="password" placeholder="Password" required>

            <div class="button-container">
                <button type="submit" class="button">LOGIN</button>

            </div>
        </form>
        <p class="register-text">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </div>

    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            if (email.trim() === "" || password.trim() === "") {
                alert("Email dan Password tidak boleh kosong!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
