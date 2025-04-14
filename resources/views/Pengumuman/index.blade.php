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

    <!-- Hero section start -->
    {{-- Anda bisa menyesuaikan atau menghapus hero section ini jika tidak relevan untuk halaman pengumuman --}}
    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL <span> ENGLISH COURSE </span></h1>
            {{-- CTA bisa diarahkan ke halaman lain jika perlu, atau dihapus --}}
            <a href="{{ route('login') }}" class="cta">Login/Daftar</a>
        </main>
    </section>
    <!-- Hero section end -->

    {{-- Section khusus untuk menampilkan pengumuman --}}
    <section id="pengumuman-terbaru" class="pengumuman-terbaru kelas-belajar"> {{-- ID & Class disesuaikan, bisa pakai class 'kelas-belajar' jika styling sama --}}
        <h2><span>Pengumuman</span> Terbaru</h2>
        <div class="content">
            <table>
                <thead> {{-- Tambahkan thead untuk struktur tabel yang lebih baik --}}
                    <tr>
                        <th>Judul Pengumuman</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Pastikan variabel $semua_pengumuman dikirim dari controller showPublic --}}
                    @if(isset($semua_pengumuman) && count($semua_pengumuman) > 0)
                        @foreach ($semua_pengumuman as $item)
                            <tr>
                                <td>{{ $item->judul_pengumuman }}</td>
                                {{-- Format tanggal, pastikan $item->tanggal adalah objek Carbon --}}
                                <td>{{ $item->tanggal instanceof \Carbon\Carbon ? $item->tanggal->format('d M Y') : $item->tanggal }}</td>
                                {{-- Tampilkan deskripsi, mungkin perlu penyesuaian jika terlalu panjang untuk tabel --}}
                                <td>{!! nl2br(e($item->deskripsi)) !!}</td> {{-- nl2br untuk ganti baris, e() untuk escape HTML --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" style="text-align: center;">Tidak ada pengumuman terbaru saat ini.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>

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

</html>
