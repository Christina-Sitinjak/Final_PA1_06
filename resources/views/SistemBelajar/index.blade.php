<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->


    <!-- Sistem Belajar section start -->

    <section id="sistem-belajar" class="sistem-belajar">
        <h2 class="judul-sistem">Sistem Belajar</h2>
        <div class="sistem-belajar-container">
            @foreach($sistemBelajars as $item)
                <div class="feature-card">
                    @if($item->ikon)
                        <i class="{{ $item->ikon }}"></i>
                    @else
                        <i class="fas fa-question-circle"></i> <!-- Ikon fallback jika tidak ada ikon -->
                    @endif
                    <strong>{{ $item->judul }}</strong>
                    <p>{{ $item->deskripsi }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Sistem Belajar section end -->

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
    :root {
    --coklat-susu: #d2b48c;
    --putih: #ffffff;
    --font-dark: #3e2f1c;
    --font-light: #555;
    --shadow: rgba(0, 0, 0, 0.1);
}

/* Container kartu */

.sistem-belajar-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Lebih responsif */
    gap: 25px;
    padding: 0 20px;
    justify-items: center;
}

/* Kartu fitur */
.feature-card {
    background-color: var(--putih);
    border: 2px solid var(--coklat-susu);
    border-radius: 15px;
    padding: 25px 20px;
    box-shadow: 0 8px 16px var(--shadow);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.6s ease both;
    width: 100%; /* Lebar 100% agar responsif di dalam grid */
    box-sizing: border-box; /* Pastikan padding dan border tidak menambah lebar elemen */
}

.feature-card i {
    font-size: 2rem;
    color: var(--coklat-susu);
    margin-bottom: 10px;
    display: block;
}

.feature-card strong {
    color: var(--font-dark);
    font-size: 1.1rem;
    display: block;
    margin-bottom: 8px;
}

.feature-card p {
    color: #555;
    font-size: 0.95rem;
    margin: 6px 0;
    line-height: 1.5;
}

/* Hover efek */
.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

/* Animasi masuk */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive padding */
@media (max-width: 600px) {
    .feature-card {
        padding: 20px 15px;
    }
}
</style>


</html>
