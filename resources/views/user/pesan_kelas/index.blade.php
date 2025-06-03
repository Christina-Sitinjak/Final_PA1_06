<!DOCTYPE html>
<html>
<head>
    @include('user.head')
    <title>Daftar Pemesanan Kelas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
    display: flex;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

/* Sidebar */
.sidebar {
    width: 250px;
    min-height: 100vh;
    background-color: #3f51b5;
    color: white;
    flex-shrink: 0;
}

/* Konten Utama */
.main-content {
    flex: 1;
    padding: 30px;
    background-color: #f5f7fa;
    overflow-x: auto;
}

/* Container dalam konten */
.main-content .container {
    max-width: 100%;
    padding: 25px;
    margin: 0 auto;
}

        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 200px; /* Lebar sidebar sesuai gambar */
            background-color: #3f51b5;  /* Warna sidebar sesuai gambar */
            color: white; /* Teks di sidebar putih */
        }

        .sidebar a {
            color: white;  /* Warna link di sidebar */
            text-decoration: none;
            display: block;
            padding: 8px 16px;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Efek hover sedikit lebih terang */
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #343a40;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #357abd;
            border-color: #357abd;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: middle !important;
            text-align: center;
        }

        .table thead {
            background-color: #e9ecef;
        }

        .btn-sm {
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
        }

        .btn-sm.btn-primary {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .btn-sm.btn-primary:hover {
            background-color: #218838;
        }

        .btn-sm.btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-sm.btn-danger:hover {
            background-color: #c82333;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination li {
            display: inline;
            margin: 0 5px;
        }

        .pagination li a {
            color: #007bff;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .pagination li a:hover {
            background-color: #f2f2f2;
        }

        .pagination .active a {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                order: 1; /* Sidebar muncul di atas konten di layar kecil */
                margin-bottom: 20px; /* Ruang antara sidebar dan konten */
            }

            .main-content {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }
        }
    </style>
</head>
    <!-- Sidebar -->
    <div class="sidebar">
        @include('user.sidebar')
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h1>Pemesanan Kelas</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($bolehPesan)
                <a href="{{ route('user.pesan_kelas.create') }}" class="btn btn-primary">Tambah Pemesanan</a>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Asal Sekolah</th>
                        <th>Kategori</th>
                        <th>Tingkatan</th>
                        <th>Kelas</th>
                        <th>Program</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesanKelas as $pesan)
                        <tr>
                            <td>{{ $pesan->nama }}</td>
                            <td>{{ $pesan->alamat }}</td>
                            <td>{{ $pesan->asal_sekolah }}</td>
                            <td>{{ $pesan->program->category->nama_kategori }}</td>
                            <td>{{ $pesan->tingkatan }}</td>
                            <td>{{ $pesan->kelas }}</td>
                            <td>{{ $pesan->program->nama_program }}</td>
                            <td>{{ $pesan->jadwal }}</td>
                            <td>{{ $pesan->status }}</td>
                            <td class="text-center">
                                @if ($pesan->status == 'approved')
                                    <a href="{{ route('user.pesan_kelas.show_approved', $pesan->pesan_kelas_id) }}" class="btn btn-sm btn-primary">View</a>
                                @elseif ($pesan->status == 'diproses' || $pesan->status == 'pending')
                                    <a href="{{ route('user.pesan_kelas.edit', $pesan->pesan_kelas_id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('user.pesan_kelas.destroy', $pesan->pesan_kelas_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Batalkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Belum ada pemesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $pesanKelas->links() }}
        </div>
    </div>
</body>
</html>
