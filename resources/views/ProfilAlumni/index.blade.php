<!DOCTYPE html>
<html lang="id">
<head>
    @include('layout.header')
    <title>Daftar Profil Alumni</title>
    <style>
        .profil_alumni {
            text-align: center;
            padding: 50px 20px;
        }
        .profil_alumni h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
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
</head>
<body>
    @include('layout.navbar')

    <section class="hero" id="home">
        <main class="content">
            <h1>UNIVERSAL<span> ENGLISH COURSE </span></h1>
            <a href="{{ route('login') }}" class="cta">Pesan Sekarang</a>
        </main>
    </section>

    <section id="profil_alumni" class="profil_alumni">
        <h2><span>Daftar</span> Profil Alumni</h2>
        <div class="profil-container">
            @if(isset($profilAlumnis) && count($profilAlumnis) > 0)
                @foreach ($profilAlumnis as $profilAlumni)
                    <div class="profil-card">
                        @if($profilAlumni->gambar)
                            <img src="{{ asset('storage/profil_alumnis/' . $profilAlumni->gambar) }}" alt="{{ $profilAlumni->nama }}">
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
    </section>

    @include('layout.footer')

    <script>
        feather.replace()
    </script>
    <script src="{{URL::asset('js/script.js')}}"></script>
</body>
</html>
