<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register</title>
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

        .register-container {
            background-color: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
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

        .login-text {
            color: var(--dark-choco);
            margin-top: 15px;
            font-size: 14px;
        }

        .login-text a {
            color: #8d5b3f;
            text-decoration: none;
            font-weight: bold;
        }

        .login-text a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Logo dan Judul -->
        <img src="img/ueclogo.png" alt="Logo UEC" class="logo">
        <div class="site-title">Universal English Course</div>

        <h1>Register</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('registers') }}" onsubmit="return validateRegisterForm()">
            @csrf
            <input type="text" class="input-field" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
            <input type="email" class="input-field" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="text" class="input-field" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}">
            <input type="password" class="input-field" id="password" name="password" placeholder="Password" required>
            <input type="password" class="input-field" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>

            <div class="button-container">
                <button type="submit" class="button">REGISTER</button>
            </div>
        </form>

        <p class="login-text">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
    </div>

    <script>
        function validateRegisterForm() {
            var name = document.getElementById('name').value.trim();
            var email = document.getElementById('email').value.trim();
            var password = document.getElementById('password').value.trim();
            var confirm = document.getElementById('password_confirmation').value.trim();

            if (!name || !email || !password || !confirm) {
                alert("Semua field harus diisi!");
                return false;
            }

            if (password !== confirm) {
                alert("Password dan konfirmasi tidak cocok!");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
