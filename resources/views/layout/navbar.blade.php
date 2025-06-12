<nav class="navbar">
    <div class="navbar-brand">
      <img src="img/ueclogo.png" alt="UEC Logo" style="margin-right: 0.5rem;">
      <a href="{{ route('welcome') }}" class="navbar-logo"><span>UEC</span> Laguboti</a>
    </div>

    <div class="navbar-nav">
        <a href="{{ route('welcome') }}" class="{{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>
        <a href="{{ route('sistem_belajar') }}" class="{{ request()->routeIs('sistem_belajar') ? 'active' : '' }}">Sistem Belajar</a>
        <a href="{{ route('jadwal_belajar') }}" class="{{ request()->routeIs('jadwal_belajar') ? 'active' : '' }}">Jadwal Belajar</a>
        <a href="{{ route('program') }}" class="{{ request()->routeIs('program') ? 'active' : '' }}">Kelas</a>
        <a href="{{ route('pengajar') }}" class="{{ request()->routeIs('pengajar') ? 'active' : '' }}">Pengajar</a>
        <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'active' : '' }}">Galeri</a>

        <div class="dropdown">
            <a href="#" class="dropdown-toggle {{ request()->routeIs('profil_alumni', 'pengumuman') ? 'active' : '' }}">Informasi ▾</a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('profil_alumni') }}" class="{{ request()->routeIs('profil_alumni') ? 'active' : '' }}">Profil Alumni</a></li>
                <li><a href="{{ route('pengumuman') }}" class="{{ request()->routeIs('pengumuman') ? 'active' : '' }}">Pengumuman</a></li>
            </ul>
        </div>

        <a href="{{ route('login') }}" class="login-btn">Login</a>


        @auth
            <!-- Tautan Logout Jika Pengguna Sudah Login -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        @endauth
    </div>
</nav>

<style>
    /* Style Navbar */
    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 2rem;
        background-color: #222;
        color: #fff;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
    }

    .navbar-logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: #fff;
        text-decoration: none;
    }

    .navbar-logo span {
        color: #b6895b;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
    }

    .navbar-nav a {
        color: #fff;
        text-decoration: none;
        margin: 0 1rem;
        transition: color 0.3s ease;
    }

    .navbar-nav a:hover {
        color: #b6895b;
    }

    /* Style Dropdown */
    .navbar-nav .dropdown {
        position: relative;
        display: flex;
        align-items: center;
    }

    .navbar-nav .dropdown-toggle {
        cursor: pointer;
        color: #fff;
        text-decoration: none;
        margin: 0 1rem;
        transition: color 0.3s ease;
        display: flex;
        align-items: center;
    }

    .navbar-nav .dropdown-toggle:hover {
        color: #b6895b;
    }

    .navbar-nav .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #333;
        border: 1px solid #555;
        padding: 0.5rem 0;
        list-style: none;
        display: none;
        z-index: 1000;
        min-width: 150px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .navbar-nav .dropdown:hover .dropdown-menu {
        display: block;
    }

    .navbar-nav .dropdown-menu li a {
        display: block;
        padding: 0.5rem 1rem;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .navbar-nav .dropdown-menu li a:hover {
        background-color: #555;
        color: #b6895b;
    }

    /* Style Tautan Aktif */
    .navbar-nav a.active, .navbar-nav .dropdown-toggle.active {
        color: #b6895b;
        font-weight: bold;
    }
</style>
