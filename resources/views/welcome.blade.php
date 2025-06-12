<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <style>
        /* Umum */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .green-text {
            color: #3bb143;
        }

        /* Menu Grid */
        #menu-grid {
            padding: 50px 20px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .menu-item {
            position: relative;
            overflow: hidden;
        }

        .menu-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .menu-item .overlay {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 10px;
        }

        /* About Section */
        #about {
            padding: 4rem 2rem;
            color: #ffffff;
        }

        #about h2 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .about-row {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: center; /* Pusatkan item secara vertikal */
        }

        .about-column {
            flex: 1 1 50%;
        }

        .about-column img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
            display: block; /* Hilangkan ruang ekstra di bawah gambar */
            margin-left: auto;
            margin-right: auto;
        }

        .about-column:first-child img {
          max-width: 200px; /* Ukuran logo */
          height: auto;
        }

        .about-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
        }

        .about-column p {/* Jika ada <span> di dalam <p> */
            margin-bottom: 1rem;
            line-height: 1.6;
            text-align: justify;
            font-size: 1.2rem; /* Sesuaikan nilai ini! */
        }

    </style>
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <!-- Hero section start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL <span> ENGLISH COURSE </span></h1>
        </main>
    </section>
    <!-- Hero section end -->

    <!-- About section start -->
    <section id="about">
        <div class="container">
            <h2 class="judul-home">Tentang Kami</h2>
            <div class="about-row">
                <div class="about-column">
                    <img src="img/ueclogo.png" alt="UEC Logo">
                    <h3 class="about-title">
                        Learning <span class="green-text">Today</span> For A Better <span
                            class="green-text">Tomorrow</span>
                    </h3>
                </div>
                <div class="about-column">
                    <p>
                        Slogan "Learning Today For A Better Tomorrow" memiliki makna bahwa proses belajar yang dilakukan hari ini
                        merupakan bekal penting untuk meraih masa depan yang lebih baik. Melalui usaha dan komitmen dalam belajar,
                        terutama dalam mengembangkan kemampuan bahasa Inggris, siswa dipersiapkan untuk menghadapi tantangan global,
                        membuka peluang karier, dan mencapai impian mereka. UEC Laguboti ingin menginspirasi setiap peserta didik
                        untuk menyadari bahwa setiap langkah kecil dalam belajar hari ini akan memberikan dampak besar bagi
                        kesuksesan mereka di masa depan.
                    </p>
                    <img src="img/de.jpg" alt="Tentang Kami">
                </div>
            </div>
        </div>
    </section>
    <!-- About section end -->

    <section id="sistem-belajar" class="sistem-belajar">
        <h2 class="judul-sistem">Sistem Belajar</h2>
        <div class="sistem-belajar-container">
            @foreach($sistemBelajars as $item)
                <div class="feature-card">
                    @if($item->ikon)
                        <i class="{{ $item->ikon }}"></i>
                    @else
                        <i class="fas fa-question-circle"></i> <!-- Ikon fallback jika tidak ada ikon -->
                    @endif
                    <strong>{{ $item->judul }}</strong>
                    <p>{{ $item->deskripsi }}</p>
                </div>
            @endforeach
        </div>
        <div style="text-align: center;">
            <a href="{{ route('sistem_belajar') }}" class="btn-lainnya">Sistem Belajar Lainnya</a>
        </div>
        </section>

    <section id="kelas" class="kelas">
        <h2 class="judul-kelas">Daftar Kelas</h2>
    <div class="kelas-container">
        @if(isset($programs) && count($programs) > 0)
            @foreach ($programs as $kelasItem)
                <div class="kelas-card">
                    <i class="fas fa-book kelas-icon"></i> <!-- Font Awesome Icon (contoh) -->
                    <h3 class="kelas-title">{{ $kelasItem->nama_program }}</h3>
                    <p class="kelas-info">
                        <strong>Kategori:</strong> {{ $kelasItem->category ? $kelasItem->category->nama_kategori : 'Tidak ada kategori' }}
                    </p>
                    <p class="kelas-harga">
                        Harga Pendaftaran: Rp{{ number_format($kelasItem->harga_pendaftaran, 0, ',', '.') }}
                    </p>
                    <p class="kelas-harga">
                        Harga Kursus/Bulan: Rp{{ number_format($kelasItem->harga_kursus, 0, ',', '.') }}
                    </p>
                    <p class="kelas-info">
                        Masa Belajar: {{ $kelasItem->masa_belajar }} bulan
                    </p>
                    <a href="{{ route('register') }}" class="btn-daftar">Daftar Sekarang</a>
                </div>
            @endforeach
        @else
            <p>Tidak ada kelas yang tersedia saat ini.</p>
        @endif
    </div>
        <div style="text-align: center;">
            <a href="{{ route('program') }}" class="btn-lainnya">Kelas Lainnya</a>
        </div>
    </section>

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
        <div style="text-align: center;">
            <a href="{{ route('pengajar') }}" class="btn-lainnya">Pengajar Lainnya</a>
        </div>
    </section>

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
        <div style="text-align: center;">
            <a href="{{ route('galeri') }}" class="btn-lainnya">Galeri Lainnya</a>
        </div>
    </section>

    <section id="profil_alumni" class="profil_alumni">
        <h2 class="judul-alumni">Daftar Profil Alumni</h2>
        <div class="profil-container">
            @if(isset($profilAlumnis) && count($profilAlumnis) > 0)
                @foreach ($profilAlumnis as $profilAlumni)
                    <div class="profil-card">
                        @if($profilAlumni->gambar)
                            <img src="{{ asset('storage/profil_alumni/' . $profilAlumni->gambar) }}" alt="{{ $profilAlumni->nama }}">
                        @else
                            <img src="https://via.placeholder.com/150" alt="No Image">
                        @endif
                        <h3>{{ $profilAlumni->nama }}</h3>
                        <p><strong>Tahun Lulus:</strong> {{ $profilAlumni->tahun_lulus }}</p>
                        <p>{{ $profilAlumni->deskripsi }}</p>
                    </div>
                @endforeach
            @else
                <p>Tidak ada profil alumni yang tersedia saat ini.</p>
            @endif
        </div>
        <div style="text-align: center;">
            <a href="{{ route('profil_alumni') }}" class="btn-lainnya">Profil Alumni Lainnya</a>
        </div>
    </section>

    <!-- Tombol Pesan Sekarang -->
    <section style="text-align:center; margin: 40px 0;">
        <a href="{{ route('login') }}" class="btn-pesan">Pesan Sekarang!</a>
    </section>

<style>
    :root {
    --coklat-susu: #d2b48c;
    --putih: #ffffff;
    --font-dark: #3e2f1c;
    --font-light: #555;
    --shadow: rgba(0, 0, 0, 0.1);
}

/* Bagian utama section */
#sistem-belajar {
    padding: 10px;
    font-family: 'Segoe UI', sans-serif;
}


/* Container kartu */

.sistem-belajar-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 25px;
    padding: 0 20px;
    justify-items: center;
}

/* Kartu fitur */
.feature-card {
    background-color: var(--putih);
    border: 2px solid var(--coklat-susu);
    border-radius: 15px;
    padding: 25px 20px;
    box-shadow: 0 8px 16px var(--shadow);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.6s ease both;
}

.feature-card i {
    font-size: 2rem;
    color: var(--coklat-susu);
    margin-bottom: 10px;
    display: block;
}

.feature-card strong {
    color: var(--font-dark);
    font-size: 1.1rem;
    display: block;
    margin-bottom: 8px;
}

.feature-card p {
    color: #555;
    font-size: 0.95rem;
    margin: 6px 0;
    line-height: 1.5;
}

/* Hover efek */
.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

/* Animasi masuk */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive padding */
@media (max-width: 600px) {
    .feature-card {
        padding: 20px 15px;
    }
}
</style>

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
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
        feather.replace()
    </script>

    <!-- My Javascript -->
    <script src="{{URL::asset('js/script.js')}}"></script>
</body>
@include('layout.footer')

</html>

<style>
/* Gaya untuk container utama */
.kelas-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Pusatkan horizontal */
    gap: 30px;
    padding: 30px;
}

/* Gaya untuk card kelas */
.kelas-card {
    background-color: #f8f0e3; /* Krem */
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    width: 320px; /* Lebar card */
    padding: 25px;
    margin: 15px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.kelas-card:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

/* Gaya untuk judul kelas */
.kelas-title {
    font-size: 1.8em;
    margin-bottom: 12px;
    color: #6a4a3c; /* Cokelat tua */
    font-family: 'Arial', sans-serif; /* Font yang lebih modern */
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Gaya untuk ikon kelas */
.kelas-icon {
    font-size: 2em;
    margin-bottom: 10px;
    color: #b38b6d; /* Cokelat muda */
}

/* Gaya untuk informasi kelas */
.kelas-info {
    font-size: 1.1em;
    color: #85644d;
    margin-bottom: 10px;
    line-height: 1.4;
}

/* Gaya untuk harga */
.kelas-harga {
    font-size: 1.3em;
    font-weight: bold;
    color: #a87e54;
    margin-bottom: 15px;
}

/* Gaya untuk tombol daftar */
.btn-daftar {
    background-color: #a87e54;
    color: #fff;
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 1.1em;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
}

.btn-daftar:hover {
    background-color: #85644d;
}
    </style>

    <style>
        /* Gaya tambahan untuk memperbaiki tampilan */
        #pengajar {
            padding: 20px;
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
.btn-lainnya {
    background-color: #ffffff; /* Latar belakang krem */
    color: #000000; /* Warna teks cokelat tua */
    padding: 12px 24px; /* Ukuran padding */
    font-size: 1rem; /* Ukuran font */
    font-weight: bold; /* Tebal font */
    border-radius: 8px; /* Radius border */
    text-decoration: none; /* Menghilangkan garis bawah */
    transition: background-color 0.3s ease; /* Transisi hover */
    display: inline-block; /* Agar padding berfungsi dengan baik */
    border: none; /* Hilangkan border */
}

.btn-lainnya:hover {
    background-color: #d2b48c; /* Warna latar belakang saat dihover (cokelat lebih tua) */
    color: #fff; /* Warna teks saat dihover (putih) */
}
    </style>

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

    <style>
        .profil_alumni {
            text-align: center;
            background-color: #000;
        }
        .judul-alumni {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #fff ;
        }
        .profil-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px;
        }
        .profil-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            padding: 25px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }
        .profil-card:hover {
            transform: translateY(-10px);
        }
        .profil-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 5px solid #ddd;
        }
        .profil-card h3 {
            margin: 10px 0 5px;
            font-size: 1.4em;
            color: #222;
        }
        .profil-card p {
            font-size: 1em;
            color: #555;
            line-height: 1.5;
        }

    </style>
