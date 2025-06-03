<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Daftar Pengajar (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            padding: 20px 30px 30px 260px; /* space for sidebar on left */
        }

        .card {
            margin-top: 1rem;
            border: none;
            border-radius: 12px;
        }
        .card-header .btn {
            margin-left: auto;
        }
        .card-header {
            background-color: #e3f2fd;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .table th, .table td {
            vertical-align: middle !important;
            text-align: center;
        }

        .table img {
            width: 60px;
            height: auto;
            border-radius: 6px;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-hapus {
            background-color: #c9c014;
            color: white;
        }

        .btn-edit:hover, .btn-hapus:hover {
            opacity: 0.9;
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
                <span>Daftar Pengajar</span>
                <a href="{{ route('admin.pengajar.create') }}" class="btn btn-primary">+ Tambah Pengajar</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Nomor Telepon</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengajars as $pengajar)
                                <tr>
                                    <td>{{ ($pengajars->currentPage() - 1) * $pengajars->perPage() + $loop->iteration }}</td>
                                    <td>{{ $pengajar->nama_pengajar }}</td>
                                    <td>
                                        @if($pengajar->gambar)
                                            <img src="{{ asset('storage/' . $pengajar->gambar) }}" alt="{{ $pengajar->nama_pengajar }}" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $pengajar->phone_number }}</td>
                                    <td>{{ $pengajar->deskripsi }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.pengajar.edit', $pengajar->pengajar_id) }}" class="btn btn-sm btn-edit">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.pengajar.destroy', $pengajar->pengajar_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-hapus">
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
                {{ $pengajars->links() }}  <!-- Menampilkan link pagination -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
