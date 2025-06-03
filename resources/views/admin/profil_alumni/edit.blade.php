<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Edit Profil Alumni (Admin)</title>
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

        .card {
            height: 100%;
        }

        .card-header {
            background-color: #e3f2fd;
            font-weight: bold;
            font-size: 1.25rem;
            color: #333;
        }

        .btn-update {
            background-color: #0d6efd;
            color: #fff;
            border: none;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: #fff;
            border: none;
        }

        .btn-update:hover,
        .btn-cancel:hover {
            opacity: 0.9;
        }

        img.preview {
            margin-top: 10px;
            border-radius: 8px;
            max-width: 120px;
        }

        .form-label {
            font-weight: 500;
        }
    </style>
</head>
<body>
    @include('admin.navbar')
    @include('admin.sidebar')
    <div class="main-wrapper">
        <div class="card shadow">
            <div class="card-header">
                Edit Profil Alumni
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

                <form action="{{ route('admin.profil_alumni.update', $profilAlumni->profil_alumni_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $profilAlumni->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                        @if($profilAlumni->gambar)
                            <img src="{{ asset('storage/profil_alumni/' . $profilAlumni->gambar) }}" alt="{{ $profilAlumni->nama }}" class="preview">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                        <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" value="{{ $profilAlumni->tahun_lulus }}">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $profilAlumni->deskripsi }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-update me-2">Update</button>
                        <a href="{{ route('admin.profil_alumni.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
