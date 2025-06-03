<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <title>Galeri Kami</title>
    <style>
        /* Gaya tambahan untuk tampilan kartu */
        .galeri-card {
            width: 350px; /* Lebar yang lebih besar dari sebelumnya agar sesuai gambar*/
            margin: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #333; /* Warna latar belakang gelap */
            color: #fff; /* Warna teks putih */
            text-align: center; /* Tengahkan konten */
        }

        .galeri-card img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover; /* Penting untuk menjaga aspek rasio dan mengisi area */
            max-height: 250px; /* Batasi tinggi gambar */
        }

        .galeri-card .card-content {
            padding: 15px;
        }

        .galeri-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .galeri-card .card-title {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.2em;
        }
    </style>
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <section id="galeri" class="galeri">
        <h2 class="judul-galeri">Galeri Kami</h2>
        <div class="galeri-container">
            @if(isset($galeris) && count($galeris) > 0)
                @foreach ($galeris as $galeri)
                    <div class="galeri-card">
                        <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}" alt="{{ $galeri->deskripsi }}">
                        <div class="card-content">
                            <h3 class="card-title">{{ $galeri->deskripsi }}</h3>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Tidak ada gambar di galeri saat ini.</p>
            @endif
        </div>
    </section>

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
