<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
</head>

<body>
    <!-- Navbar start -->
    @include('layout.navbar')
    <!-- Navbar end -->


    <!-- Sistem Belajar section start -->

    <section id="sistem-belajar" class="sistem-belajar">
        <h2 class="judul-sistem">Sistem Belajar</h2>
        <div class="sistem-belajar-container">
            <div class="feature-card">
                <i class="fas fa-sync-alt"></i> <!-- Icon: Sync -->
                <strong>Pergantian program setiap 2 bulan:</strong>
                <p>Pengajar berbahasa Inggris, siswa/i berbahasa Indonesia</p>
                <p>Pengajar berbahasa Indonesia, siswa/i berbahasa Inggris</p>
                <p>Pengajar dan siswa/i berbahasa Inggris</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-users"></i> <!-- Icon: Users -->
                <strong>Praktek berbicara dengan orang asing:</strong>
                <p>Dilaksanakan setiap 2 bulan sekali. Memberikan pengalaman nyata dan meningkatkan kepercayaan diri.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-graduation-cap"></i> <!-- Icon: Graduation Cap -->
                <strong>Ujian Akhir:</strong>
                <p>Berpidato di depan penguji dan orang tua. Menguji kemampuan dan kepercayaan diri.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-certificate"></i> <!-- Icon: Certificate -->
                <strong>Sertifikat:</strong>
                <p>Diberikan bagi siswa yang berhasil tamat. Sebagai bukti kemampuan dan prestasi.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-comments"></i> <!-- Icon: Comments -->
                <strong>Diskusi terpadu:</strong>
                <p>Diadakan di luar jam belajar. Memperdalam pemahaman dan mempererat hubungan antar siswa.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-chalkboard-teacher"></i> <!-- Icon: Chalkboard Teacher -->
                <strong>Diklat lanjutan:</strong>
                <p>Bagi yang tamat, berhak mengikuti pelatihan Asisten, Leader, dan Teacher. Meningkatkan kompetensi dan peluang karier.</p>
            </div>
            <!-- Tambahan Card -->
            <div class="feature-card">
                <i class="fas fa-book-open"></i> <!-- Icon: Book Open -->
                <strong>Materi interaktif:</strong>
                <p>Menggunakan buku, video, dan aplikasi. Membuat belajar lebih menyenangkan dan efektif.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-globe"></i> <!-- Icon: Globe -->
                <strong>Kurikulum global:</strong>
                <p>Mengacu pada standar internasional. Mempersiapkan siswa menghadapi tantangan global.</p>
            </div>
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

/* Bagian utama section */


/* Container kartu */

.sistem-belajar-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
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
