<nav class="navbar">
    <img src="img/ueclogo.png" alt="Tentang Kami">
    <a href="#" class="navbar-logo"><span>UEC</span> Laguboti</a>

    <div class="navbar-nav">
        <a href="{{ route('welcome') }}">Home</a>
        <a href="{{ route('sistembelajar') }}">Sistem Belajar</a>
        <a href="{{ route('jadwalbelajar') }}">Jadwal Belajar</a>
        <a href="{{ route('kelas') }}">Kelas</a>
        <a href="{{ route('pengajar') }}">Pengajar</a>
        <a href="{{ route('galeri') }}">Galeri</a>
        <a href="{{ route('profil_alumni') }}">Profil Alumni</a>
        <a href="{{ route('pengumuman') }}">Pengumuman</a>

        @auth
            <!-- Tautan Logout Jika Pengguna Sudah Login -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        @else
            <!-- Tautan Login Jika Pengguna Belum Login -->
            <a href="{{ route('login') }}">Pemesanan Kelas</a>
        @endauth
    </div>
</nav>
