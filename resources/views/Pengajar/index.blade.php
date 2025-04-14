<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <title>Daftar Pengajar</title>
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->

    <!-- Hero section start (Anda mungkin ingin menyesuaikan ini atau menghapusnya) -->
    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL <span> ENGLISH COURSE </span></h1>
            <a href="{{ route('login') }}" class="cta">Pesan Sekarang</a> <!-- Sesuaikan link ini -->
        </main>
    </section>
    <!-- Hero section end -->

    <section id="pengajar" class="pengajar">
        <h2><span>Daftar</span> Pengajar</h2>
        <div class="content">
            <table>
                <tr>
                    <th>NAMA PENGAJAR</th>
                    <th>FOTO</th>
                    <th>NOMOR TELEPON</th>
                    <th>DESKRIPSI</th>
                </tr>
                @if(isset($pengajars) && count($pengajars) > 0)
                    @foreach ($pengajars as $pengajar)
                        <tr>
                            <td>{{ $pengajar->nama_pengajar }}</td>
                             <td>
                                @if($pengajar->gambar)
                                    <img src="{{ asset('storage/pengajars/' . $pengajar->gambar) }}" alt="{{ $pengajar->nama_pengajar }}" width="50">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $pengajar->phone_number }}</td>
                            <td>{{ $pengajar->deskripsi }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Tidak ada pengajar yang tersedia saat ini.</td>
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
