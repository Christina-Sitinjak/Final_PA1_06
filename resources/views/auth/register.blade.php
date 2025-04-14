<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
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

        .register-container {
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

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Admin Register</h1>

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
    </div>

    <script>
        function validateRegisterForm() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var password_confirmation = document.getElementById('password_confirmation').value;

            if (name.trim() === "" || email.trim() === "" || password.trim() === "" || password_confirmation.trim() === "") {
                alert("Semua field harus diisi!");
                return false;
            }

            if (password !== password_confirmation) {
                alert("Password dan konfirmasi password tidak sama!");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
