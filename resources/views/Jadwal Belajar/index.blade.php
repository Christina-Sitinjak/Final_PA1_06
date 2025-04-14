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
            <h1>UNIVERSAL<span> ENGLISH COURSE </span></h1>
            <a href="{{ route('login')}}" class="cta">Pesan Sekarang</a>
        </main>
    </section>
    <!-- Hero section end -->

    <section id="jadwal-belajar" class="jadwal-belajar">
        <h2><span>Jadwal</span> Belajar</h2>
        <div class="content">
            <table>
                <tr>
                    <th>PROGRAM</th>
                    <th>Senin & Rabu</th>
                    <th>Selasa & Kamis</th>
                </tr>
                <tr>
                    <td>PRIMARY</td>
                    <td>13.45 – 15.00</td>
                    <td>13.45 – 15.00</td>
                </tr>
                <tr>
                    <td>ADVANCE</td>
                    <td>14.15 – 16.00</td>
                    <td>14.15 – 16.00</td>
                </tr>
                <tr>
                    <td>SPC</td>
                    <td>15.00 – 17.30</td>
                    <td>15.00 – 17.30</td>
                </tr>

                <tr class="private-class">
                    <td colspan="3"><strong>Tersedia Juga Private Class</strong></td>
                </tr>
                <tr class="private-class">
                    <td colspan="3"><strong>Jumat & Sabtu</strong></td>
                </tr>
            </table>
        </div>
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
