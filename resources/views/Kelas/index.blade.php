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

    <!-- Hero section start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL <span> ENGLISH COURSE </span></h1>
            <a href="{{ route('login') }}" class="cta">Pesan Sekarang</a>
        </main>
    </section>
    <!-- Hero section end -->

    <section id="kelas-belajar" class="kelas-belajar">
        <h2><span>Daftar</span> Kelas</h2>
        <div class="content">
            <table>
                <tr>
                    <th>NAMA KELAS</th>
                    <th>MASA BELAJAR</th>
                    <th>HARGA PENDAFTARAN</th>
                    <th>HARGA KURSUS</th>
                </tr>
                @if(isset($kelas) && count($kelas) > 0)
                    @foreach ($kelas as $kelasItem)
                        <tr>
                            <td>{{ $kelasItem->nama_kelas }}</td>
                            <td>{{ $kelasItem->masa_belajar }} Bulan</td>
                            <td>Rp. {{ number_format($kelasItem->harga_pendaftaran, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($kelasItem->harga_kursus, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">Tidak ada kelas yang tersedia saat ini.</td>
                    </tr>
                @endif
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
