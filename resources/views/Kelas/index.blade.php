<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <title>Daftar Kelas</title>
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

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
    @include('layout.footer')
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
        feather.replace()
    </script>

    <!-- My Javascript -->
    <script src="{{URL::asset('js/script.js')}}"></script>
</body>

<style>
/* Gaya untuk container utama */
.kelas-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Pusatkan horizontal */
    gap: 30px;
    padding: 15px;
}

/* Gaya untuk card kelas */
.kelas-card {
    background-color: #f8f0e3; /* Krem */
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    width: 320px; /* Lebar card */
    padding: 15px;
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


</html>
