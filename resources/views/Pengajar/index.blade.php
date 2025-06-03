<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <title>Daftar Pengajar</title>
    <style>
        /* Gaya tambahan untuk memperbaiki tampilan */
        #pengajar {
            padding: 15px;
            /* Tambah jarak ke tepi */
        }

        .pengajar-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            /* Pusatkan card di tengah */
            gap: 30px;
            /* Jarak antar card */
            margin-bottom: 30px;
            /* Jarak dari grid ke elemen bawah */
        }

        .pengajar-card {
            background-color: #fff5e1;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: calc(20% - 24px);
            /* Lebar card */
            max-width: 100%;
            /* Lebar maksimal agar responsif */
            transition: transform 0.3s;
            text-align: center;
            margin: 0;
            /* Reset margin default */
        }

        .pengajar-card:hover {
            transform: translateY(-5px);
        }

        .pengajar-img-wrap {
            height: 250px;
            /* Tinggi gambar */
            overflow: hidden;
            background-color: #ddd;
        }

        .pengajar-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pengajar-content {
            padding: 20px;
            /* Padding konten */
        }

        .pengajar-content h3 {
            font-size: 1.2rem;
            /* Ukuran font nama */
            margin-bottom: 10px;
            color: #5c3c1e;
        }

        .pengajar-content .phone {
            font-size: 1rem;
            /* Ukuran font nomor telepon */
            color: #7a5c3b;
            margin-bottom: 8px;
        }

        .pengajar-content .desc {
            font-size: 0.9rem;
            /* Ukuran font deskripsi */
            font-style: italic;
            color: #9c7151;
        }

        .judul-pengajar {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            /* Ukuran font judul */
            color: #ffffff;
            /* Warna teks judul */
        }

        .btn-pesan {
            background-color: #b6895b;
            color: white;
            padding: 15px ;
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
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <section id="pengajar" class="py-5 px-4">
        <h2 class="judul-pengajar">Daftar Pengajar</h2>
        <div class="pengajar-grid">
            @if(isset($pengajars) && count($pengajars) > 0)
            @foreach ($pengajars as $pengajar)
            <div class="pengajar-card">
                <div class="pengajar-img-wrap">
                    @if($pengajar->gambar)
                    <img src="{{ asset('storage/' . $pengajar->gambar) }}" alt="{{ $pengajar->nama_pengajar }}">
                    @else
                    <div class="no-image">No Image</div>
                    @endif
                </div>
                <div class="pengajar-content">
                    <h3>{{ $pengajar->nama_pengajar }}</h3>
                    <p class="phone">{{ $pengajar->phone_number }}</p>
                    <p class="desc">{{ $pengajar->deskripsi }}</p>
                </div>
            </div>
            @endforeach
            @else
            <div class="text-white text-center w-100">Tidak ada pengajar yang tersedia saat ini.</div>
            @endif
        </div>
    </section>

    <!-- Tombol Pesan Sekarang -->
    <section style="text-align:center; margin: 40px 0;">
        <a href="{{ route('login') }}" class="btn-pesan">Pesan Sekarang!</a>
    </section>

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
