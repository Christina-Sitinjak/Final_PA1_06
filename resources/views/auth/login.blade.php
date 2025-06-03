<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Login</title>
    <style>
        :root {
            --milk: #f7efe5;
            --choco: #b6895b;
            --dark-choco: #5a3e36;
            --button-hover: #d7b49e;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, var(--milk), var(--choco));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            width: 80px;
            margin-bottom: 10px;
        }

        .site-title {
            font-size: 24px;
            font-weight: bold;
            color: var(--dark-choco);
            margin-bottom: 25px;
        }

        h1 {
            color: var(--dark-choco);
            font-size: 22px;
            margin-bottom: 25px;
            border-bottom: 2px solid var(--dark-choco);
            display: inline-block;
            padding-bottom: 5px;
        }

        .input-field {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 20px;
            border: none;
            border-radius: 30px;
            background-color: #fff;
            font-size: 15px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 3px var(--button-hover);
        }

        .button-container {
            margin-top: 10px;
        }

        .button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 30px;
            background: var(--dark-choco);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .button:hover {
            background: var(--button-hover);
            color: var(--dark-choco);
            transform: scale(1.03);
        }

        .register-text {
            color: var(--dark-choco);
            margin-top: 15px;
            font-size: 14px;
        }

        .register-text a {
            color: #8d5b3f;
            text-decoration: none;
            font-weight: bold;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo dan Judul -->
        <img src="img/ueclogo.png" alt="Logo UEC" class="logo">
        <div class="site-title">Universal English Course</div>

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
            var email = document.getElementById('email').value.trim();
            var password = document.getElementById('password').value.trim();

            if (!email || !password) {
                alert("Email dan Password tidak boleh kosong!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
