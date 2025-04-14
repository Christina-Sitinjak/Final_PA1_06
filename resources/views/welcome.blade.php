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

    <!-- About section start -->
    <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>
        <div class="row">
            <div class="about-img">
                <img src="img/de.jpg" alt="Tentang Kami">
            </div>
            <div class="content">
                <h3>UEC Laguboti</h3>
                <p>Universal English Course (UEC) yang berada di Laguboti merupakan lembaga pendidikan luar sekolah yakni kursus bahasa Inggris yang berkomitmen dalam memberikan pendidikan dan pengajaran yang berkualitas bagi masyarakat khususnya siswa/ siswi yang masih bersekolah di tingkat TK, SD, SMP, dan SMA dari berbagai kalangan atau lokasi yang berbeda.</p>
            </div>
        </div>
    </section>
    <!-- About section end -->

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
