<!DOCTYPE html>
<html>
<head>
    @include('user.head')
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            overflow-x: hidden;
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-info {
            border-left: 5px solid #4a90e2;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            background-color: #fff;
        }

        .card-body p {
            margin: 0.3rem 0;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            width: 140px;
            display: inline-block;
        }

        h1 {
            font-weight: bold;
            color: #343a40;
            margin-bottom: 1.5rem;
        }

        .btn-edit {
            background-color: #4a90e2;
            color: white;
            padding: 0.5rem 1.2rem;
            text-decoration: none;
            border-radius: 0.4rem;
            display: inline-block;
            margin-top: 1rem;
        }

        .btn-edit:hover {
            background-color: #357abd;
        }

        @media (max-width: 768px) {
            .info-label {
                display: block;
                margin-bottom: 0.2rem;
            }
        }
    </style>
</head>
<body class="d-flex">

<!-- Sidebar -->
@include('user.sidebar')

<!-- Main Content -->
<div class="flex-grow-1 p-4 bg-light min-vh-100 overflow-auto">
    <div class="bg-white p-4 rounded shadow-sm">
        <h1>Profil Pengguna</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-body">
                        <p><span class="info-label">Nama:</span> {{ $user->name }}</p>
                        <p><span class="info-label">Email:</span> {{ $user->email }}</p>
                        <p><span class="info-label">Tanggal Daftar:</span> {{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
