<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Menggunakan include untuk header standar --}}
    @include('layout.header')
    <title>Daftar Pengumuman - Universal English Course</title> {{-- Judul Halaman Disesuaikan --}}
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    {{-- Section khusus untuk menampilkan pengumuman --}}
<section id="pengumuman-terbaru" class="pengumuman-terbaru kelas-belajar">
    <h2 class="judul-pengumuman">Pengumuman Terbaru</h2>
    <div class="content">
        @if(isset($pengumumans) && count($pengumumans) > 0)
            @foreach ($pengumumans as $item)
                <div class="pengumuman-card">
                    <h3>{{ $item->judul_pengumuman }}</h3>
                    <p class="tanggal">
                        {{ $item->tanggal instanceof \Carbon\Carbon ? $item->tanggal->format('d M Y') : $item->tanggal }}
                    </p>
                    <div class="deskripsi">{!! nl2br(e($item->deskripsi)) !!}</div>
                </div>
            @endforeach
        @else
            <p style="text-align: center;">Tidak ada pengumuman terbaru saat ini.</p>
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
        // Pastikan library Feather Icons sudah dimuat di layout.header atau di sini
        if (typeof feather !== 'undefined') {
             feather.replace()
        }
    </script>

    <!-- My Javascript -->
    {{-- Pastikan path ke script.js benar --}}
    <script src="{{URL::asset('js/script.js')}}"></script>
</body>

<style>
/*  Bagian Pengumuman Terbaru  */
.pengumuman-terbaru {
    margin-bottom: 30px;
    padding-left: 20px; /* Spasi kiri */
    padding-right: 20px; /* Spasi kanan */
}

.judul-pengumuman {
    text-align: center;
    margin-bottom: 20px;
    color: #ffffff;
}

.pengumuman-terbaru .content {
    display: flex;
    flex-direction: column;
    gap: 20px; /* Jarak antar card pengumuman */
}

/* Style untuk setiap card pengumuman */
.pengumuman-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 20px;
    border: 1px solid #e0d1bc; /* Optional: Tambahkan border tipis */
}

.pengumuman-card h3 {
    margin-top: 0;
    margin-bottom: 10px;
    color: #54433a;
}

.pengumuman-card .tanggal {
    font-size: 0.9em;
    color: #777;
    margin-bottom: 10px;
}

.pengumuman-card .deskripsi {
    line-height: 1.6;
    color: #333;
}

</style>

</html>
