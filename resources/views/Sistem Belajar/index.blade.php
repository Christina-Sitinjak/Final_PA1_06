<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <!-- Hero section start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL <span> ENGLISH COURSE </span></h1>
            <a href="{{ route('login')}}" class="cta">Pesan Sekarang</a>
        </main>
    </section>
    <!-- Hero section end -->

    <!-- Sistem Belajar section start -->
    <section id="sistem-belajar" class="sistem-belajar">
        <h2><span>Sistem</span> Belajar</h2>
        <div class="content">
            <ul>
                <li><strong>Pergantian program setiap 2 bulan:</strong>
                    <ul>
                        <li>Pengajar berbahasa Inggris, siswa/i berbahasa Indonesia</li>
                        <li>Pengajar berbahasa Indonesia, siswa/i berbahasa Inggris</li>
                        <li>Pengajar dan siswa/i berbahasa Inggris</li>
                    </ul>
                </li>
                <li><strong>Praktek berbicara dengan orang asing:</strong> Dilaksanakan setiap 2 bulan sekali.</li>
                <li><strong>Ujian Akhir:</strong> Berpidato di depan penguji dan orang tua.</li>
                <li><strong>Sertifikat:</strong> Diberikan bagi siswa yang berhasil tamat.</li>
                <li><strong>Diskusi terpadu:</strong> Diadakan di luar jam belajar.</li>
                <li><strong>Diklat lanjutan:</strong> Bagi yang tamat, berhak mengikuti pelatihan Asisten, Leader, dan Teacher.</li>
            </ul>
        </div>
    </section>

<!-- Sistem Belajar section end -->

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
