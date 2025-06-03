<!DOCTYPE html>
<html>
<head>
    @include('user.head')
    <title>Detail Pemesanan Kelas (Approved)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            overflow-x: hidden;
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-info {
            border-left: 5px solid #4a90e2;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
            border-radius: 0.5rem;
        }

        .card-body p {
            margin: 0.3rem 0;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            width: 120px;
            display: inline-block;
        }

        h1, h2 {
            font-weight: bold;
            color: #343a40;
            margin-bottom: 1.5rem;
        }

        .info-text {
            color: #333;
        }

        .note-box {
            background-color: #e6f0ff;
            border-left: 5px solid #4a90e2;
            padding: 1rem;
            border-radius: 0.5rem;
        }

        .btn-back {
            background-color: #4a90e2;
            color: white;
            padding: 0.5rem 1.2rem;
            text-decoration: none;
            border-radius: 0.4rem;
            display: inline-block;
            margin-top: 1rem;
        }

        .btn-back:hover {
            background-color: #357abd;
        }

        @media (max-width: 768px) {
            .info-label {
                display: block;
                margin-bottom: 0.2rem;
            }
        }
    </style>
</head>
<body class="d-flex">

    <!-- Sidebar -->
    @include('user.sidebar')

    <!-- Main Content -->
    <div class="flex-grow-1 p-4 bg-light min-vh-100 overflow-auto">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1>Detail Pemesanan</h1>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-body">
                            <p><span class="info-label">Nama:</span> {{ $pesanKelas->nama }}</p>
                            <p><span class="info-label">Alamat:</span> {{ $pesanKelas->alamat }}</p>
                            <p><span class="info-label">Asal Sekolah:</span> {{ $pesanKelas->asal_sekolah }}</p>
                            <p><span class="info-label">Kategori:</span> {{ $pesanKelas->program->category->nama_kategori ?? 'Tidak ada kategori' }}</p>
                            <p><span class="info-label">Tingkatan:</span> {{ strtoupper($pesanKelas->tingkatan) }}</p>
                            <p><span class="info-label">Kelas:</span> {{ $pesanKelas->kelas }}</p>
                            <p><span class="info-label">Program:</span> {{ $pesanKelas->program->nama_program }}</p>
                            <p><span class="info-label">Jadwal:</span> {{ $pesanKelas->jadwal }}</p>
                            <p><span class="info-label">Status:</span> {{ ucfirst($pesanKelas->status) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Informasi Pendaftaran</h2>
            <div class="note-box">
                Silahkan datang ke Universal English Course untuk melakukan pendaftaran dengan membawa bukti pemesanan ini.
                Pendaftaran dapat dilakukan pada jam kerja (Senin–Jumat, 09:00–17:00).
            </div>

            <a href="{{ route('user.pesan_kelas.index') }}" class="btn-back">← Kembali</a>
        </div>
    </div>

</body>
</html>
