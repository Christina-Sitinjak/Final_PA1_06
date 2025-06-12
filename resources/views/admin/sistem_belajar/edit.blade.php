<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Edit Sistem Belajar (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            padding: 20px 30px 30px 260px; /* space for sidebar */
        }

        .card {
            margin-top: 1rem;
        }

        .card-header {
            background-color: #e3f2fd;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
        }

        .card-header .btn {
            margin-left: auto;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-hapus {
            background-color: #c9c014;
            color: white;
        }

        .btn-edit:hover,
        .btn-hapus:hover {
            opacity: 0.9;
        }

        th, td {
            vertical-align: middle !important;
            text-align: center;
        }

        .table {
            font-size: 0.95rem;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    @include('admin.navbar')
    @include('admin.sidebar')
    <div class="main-wrapper">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit Sistem Belajar</span>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sistem_belajar.update', $sistemBelajar->sistem_belajar_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul:</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $sistemBelajar->judul }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $sistemBelajar->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="ikon" class="form-label">Ikon:</label>
                        <input type="text" class="form-control" id="ikon" name="ikon" value="{{ $sistemBelajar->ikon }}">
                        <small class="text-muted">Misalnya: fas fa-book (Font Awesome), atau path ke file gambar icon</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.sistem_belajar.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
