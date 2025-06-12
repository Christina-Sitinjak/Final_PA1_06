<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Tambah Sistem Belajar Baru (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            padding: 20px 30px 30px 260px; /* menyesuaikan sidebar */
            min-height: 100vh;
            box-sizing: border-box;
        }

        .card-header {
            background-color: #e3f2fd;
            font-weight: bold;
            font-size: 1.25rem;
            color: #333;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    @include('admin.navbar')
    @include('admin.sidebar')
    <div class="main-wrapper">
        <div class="card shadow">
            <div class="card-header">
                Tambah Sistem Belajar Baru
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.sistem_belajar.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="ikon" class="form-label">Ikon</label>
                        <input type="text" class="form-control" id="ikon" name="ikon" value="{{ old('ikon') }}">
                        <small class="text-muted">Misalnya: fas fa-book (Font Awesome), atau path ke file gambar icon</small>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{ route('admin.sistem_belajar.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
