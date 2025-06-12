<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <title>Jadwal Belajar</title>
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <section id="jadwal-belajar" class="jadwal-belajar">
        <h2 class="judul-jadwal">Jadwal Belajar</h2>
        <div class="jadwal-content">
            <table>
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Program</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Berakhir</th>
                    </tr>
                </thead>
                    @forelse($jadwalBelajars as $jadwal)
                        <tr>
                            <td>{{ $jadwal->program->category->nama_kategori ?? 'Tidak Ada Kategori' }}</td>
                            <td>{{ $jadwal->program->nama_program }}</td>
                            <td>{{ $jadwal->hari }}</td>
                            <td>{{ $jadwal->jam_mulai }}</td>
                            <td>{{ $jadwal->jam_berakhir }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada jadwal belajar yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <style>
        .jadwal-content {
            max-width: 800px;
            margin: auto;
            background-color: #f5f5f5; /* Latar konten soft */
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(165, 42, 42, 0.3); /* shadow coklat susu */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fffaf5; /* warna putih dengan sedikit coklat susu */
            border-radius: 12px;
            overflow: hidden;
        }

        th {
            background-color: #d2b48c; /* Coklat susu untuk header */
            color: #5c4033; /* Coklat tua untuk teks */
            padding: 15px;
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            padding: 14px 20px;
            text-align: center;
            color: #5c4033;
            font-size: 16px;
            border-bottom: 1px solid #e0c9a6;
        }

        tr:nth-child(even) td {
            background-color: #fdf7f0; /* Baris genap warna lebih terang */
        }

        tr:hover td {
            background-color: #ecd9c6; /* Hover warna lembut */
            color: #3e2c23;
            transition: 0.3s;
        }

        .private-class td {
            background-color: #f1e0c7; /* Private class beda warna */
            font-weight: bold;
            color: #4e342e;
            font-size: 17px;
            border: none;
        }

        /* Untuk transisi yang lebih halus */
        th, td {
            transition: background-color 0.3s, color 0.3s;
        }
    </style>

    <!-- Tombol Pesan Sekarang -->
    <section style="text-align:center; margin: 40px 0;">
        <a href="{{ route('login') }}" class="btn-pesan">Pesan Sekarang!</a>
    </section>

    <style>
        .btn-pesan {
            background-color: #b6895b;
            color: white;
            padding: 15px 30px;
            font-size: 1.25rem;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: inline-block;
        }
        .btn-pesan:hover {
            background-color: #d7b49e;
        }
    </style>

    <!-- Footer start -->
    @include('layout.footer')
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
        feather.replace()
    </script>

    <!-- My Javascript -->
    <script src="{{URL::asset('js/script.js')}}"></script>
</body>
</html>
