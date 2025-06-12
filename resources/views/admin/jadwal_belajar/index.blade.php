<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Daftar Jadwal Belajar (Admin)</title>
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
                <span>Daftar Jadwal Belajar</span>
                <a href="{{ route('admin.jadwal_belajar.create') }}" class="btn btn-primary">+ Tambah Jadwal Belajar</a>
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
                                <th>Program</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Berakhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwalBelajars as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->program->nama_program }}</td>
                                    <td>{{ $item->hari }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->jam_berakhir)->format('H:i') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.jadwal_belajar.edit', $item->jadwal_belajar_id) }}" class="btn btn-sm btn-edit d-flex align-items-center">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.jadwal_belajar.destroy', $item->jadwal_belajar_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-hapus d-flex align-items-center">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada data jadwal belajar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($jadwalBelajars instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="d-flex justify-content-center mt-3">
                        {{ $jadwalBelajars->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
