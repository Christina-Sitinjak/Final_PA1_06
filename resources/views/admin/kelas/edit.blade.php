<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Edit Kelas (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            padding: 20px 30px 30px 260px; /* Sesuaikan dengan lebar sidebar */
            min-height: 100vh;
            box-sizing: border-box;
        }

        .card {
            height: 100%;
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
                Edit Kelas
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.kelas.update', $kelas->kelas_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="{{ $kelas->nama_kelas }}">
                    </div>
                    <div class="mb-3">
                        <label for="masa_belajar" class="form-label">Masa Belajar (Bulan)</label>
                        <input type="number" class="form-control" id="masa_belajar" name="masa_belajar" value="{{ $kelas->masa_belajar }}">
                    </div>
                    <div class="mb-3">
                        <label for="harga_pendaftaran" class="form-label">Harga Pendaftaran</label>
                        <input type="number" step="0.01" class="form-control" id="harga_pendaftaran" name="harga_pendaftaran" value="{{ $kelas->harga_pendaftaran }}">
                    </div>
                    <div class="mb-3">
                        <label for="harga_kursus" class="form-label">Harga Kursus</label>
                        <input type="number" step="0.01" class="form-control" id="harga_kursus" name="harga_kursus" value="{{ $kelas->harga_kursus }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
