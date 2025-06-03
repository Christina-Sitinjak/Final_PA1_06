<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Daftar Galeri (Admin)</title>
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

        table img {
            border-radius: 5px;
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
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.page-item .page-link {
    border-radius: 5px;
    margin: 0 3px;
    color: #333;
    background-color: #fff;
    border: 1px solid #ddd;
}

.page-item.active .page-link {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

    </style>
</head>
<body>
    @include('admin.navbar')

    @include('admin.sidebar')

    <div class="main-wrapper">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Daftar Galeri</span>
                <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">+ Tambah Gambar</a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($galeris as $galeri)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($galeri->gambar)
                                            <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}" alt="{{ $galeri->deskripsi }}" width="80">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $galeri->deskripsi }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.galeri.edit', $galeri->galeri_id) }}" class="btn btn-sm btn-edit d-flex align-items-center">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.galeri.destroy', $galeri->galeri_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-hapus d-flex align-items-center">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $galeris->links() }}  <!-- Menampilkan link pagination -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
