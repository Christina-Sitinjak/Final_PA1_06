<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Edit Program (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                Edit Program
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

                <form action="{{ route('admin.program.update', $program->program_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori_id" name="kategori_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $kategori)
                                <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id', $program->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_program" class="form-label">Nama Program</label>
                        <input type="text" class="form-control" id="nama_program" name="nama_program" value="{{ old('nama_program', $program->nama_program) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_pendaftaran" class="form-label">Harga Pendaftaran</label>
                        <input type="number" step="0.01" class="form-control" id="harga_pendaftaran" name="harga_pendaftaran" value="{{ old('harga_pendaftaran', $program->harga_pendaftaran) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_kursus" class="form-label">Harga Kursus</label>
                        <input type="number" step="0.01" class="form-control" id="harga_kursus" name="harga_kursus" value="{{ old('harga_kursus', $program->harga_kursus) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="masa_belajar" class="form-label">Masa Belajar</label>
                        <input type="number" class="form-control" id="masa_belajar" name="masa_belajar" value="{{ old('masa_belajar', $program->masa_belajar) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok', $program->stok) }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.program.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
