<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <title>Daftar Kategori</title>
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

    <section id="kategori" class="kategori">
        <h2><span>Daftar</span> Kategori</h2>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>NAMA KATEGORI</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($semua_kategori) && count($semua_kategori) > 0)
                        @foreach ($semua_kategori as $kategori)
                            <tr>
                                <td>{{ $kategori->nama_kategori }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>Tidak ada kategori yang tersedia saat ini.</td>
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
        feather.replace()
    </script>

    <!-- My Javascript -->
    <script src="{{URL::asset('js/script.js')}}"></script>
</body>

<style>
    /* Pengaturan untuk section kategori */
#kategori {
    background-color: #000; /* Latar belakang hitam */
    padding: 60px 20px;
}

#kategori h2 {
    text-align: center;
    color: #f5f5dc; /* Teks coklat susu terang */
    font-size: 36px;
    margin-bottom: 40px;
}

#kategori h2 span {
    color: #a67b5b; /* Coklat susu soft untuk span */
}

/* Kontainer untuk tabel kategori */
#kategori .content {
    max-width: 1200px;
    margin: auto;
    overflow-x: auto;
    background: #fdf6ee; /* Coklat susu sangat lembut */
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(166, 123, 91, 0.2);
    padding: 20px;
}

/* Styling untuk tabel kategori */
#kategori table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

#kategori th, #kategori td {
    padding: 16px 20px;
    text-align: left;
    color: #5c4033; /* Teks coklat */
    font-size: 15px;
    border-bottom: 1px solid #e0c9a6;
}

#kategori th {
    background-color: #e6d3bc; /* Header tabel coklat susu lebih tua */
    font-size: 16px;
    font-weight: bold;
    color: #4b3621;
    text-align: center; /* Menempatkan teks header di tengah */
}

#kategori tr:last-child td {
    border-bottom: none;
}

/* Efek hover pada baris tabel */
#kategori tr:hover {
    background-color: #f8efe4; /* Efek hover soft */
    transition: background-color 0.3s ease;
}

#kategori td[colspan="1"] {
    text-align: center;
    font-style: italic;
    color: #7b5e48;
}

/* Responsif pada layar kecil */
@media (max-width: 768px) {
    #kategori th, #kategori td {
        padding: 12px 10px;
        font-size: 14px;
    }
}

</style>

</html>
