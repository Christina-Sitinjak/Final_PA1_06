<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Edit Pengumuman (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            padding: 20px 30px 30px 260px;
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
                Edit Pengumuman
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

                <form action="{{ route('admin.pengumuman.update', $pengumuman->pengumuman_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul_pengumuman" class="form-label">Judul Pengumuman</label>
                        <input type="text" class="form-control" id="judul_pengumuman" name="judul_pengumuman" value="{{ old('judul_pengumuman', $pengumuman->judul_pengumuman) }}">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $pengumuman->tanggal instanceof \Carbon\Carbon ? $pengumuman->tanggal->format('Y-m-d') : $pengumuman->tanggal) }}">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $pengumuman->deskripsi) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
