<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link d-flex flex-column align-items-center justify-content-center mt-3">

        <!-- Logo dengan border dan efek halus -->
        <div style="width: 70px; height: 70px;">
            <img src="/img/ueclogo.png" alt="Logo" class="img-circle elevation-3 border border-white" style="opacity: .95; width: 70px; height: 70px; transition: transform 0.3s;">
        </div>

        <!-- Teks dengan icon -->
        <span class="mt-3 text-white fw-bold d-flex align-items-center" style="font-size: 15px;">
            <i class="fas fa-user-circle me-2"></i> Hi Admin UEC!
        </span>
    </div>
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item menu-open">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="nav-icon fas fa-house-user"></i> <!-- Ganti ikon dengan rumah -->
                <p class="nav-text">
                    Dashboard
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- Sistem Belajar -->
                <li class="nav-item">
                    <a href="{{ route('admin.sistem_belajar.index') }}" class="nav-link {{ request()->is('admin/sistem-belajar*') ? 'active' : '' }}">
                        <i class="fas fa-book nav-icon"></i>
                        <p>Sistem Belajar</p>
                    </a>
                </li>

                <!-- Jadwal Belajar -->
                <li class="nav-item">
                    <a href="{{ route('admin.jadwal_belajar.index') }}" class="nav-link {{ request()->is('admin/jadwal-belajar*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt nav-icon"></i>
                        <p>Jadwal Belajar</p>
                    </a>
                </li>

                <!-- Kelas -->
                <li class="nav-item">
                    <a href="{{ route('admin.program.index') }}" class="nav-link {{ request()->is('admin/program*') ? 'active' : '' }}">
                        <i class="fas fa-school nav-icon"></i> <!-- Ganti ikon dengan kelas -->
                        <p>Kelas</p>
                    </a>
                </li>

                <!-- Galeri -->
                <li class="nav-item">
                    <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->is('admin/galeri*') ? 'active' : '' }}">
                        <i class="fas fa-images nav-icon"></i>
                        <p>Galeri</p>
                    </a>
                </li>

                <!-- Pengajar -->
                <li class="nav-item">
                    <a href="{{ route('admin.pengajar.index') }}" class="nav-link {{ request()->is('admin/pengajar*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i> <!-- Ganti ikon dengan pengajar -->
                        <p>Pengajar</p>
                    </a>
                </li>

                <!-- Profil Alumni -->
                <li class="nav-item">
                    <a href="{{ route('admin.profil_alumni.index') }}" class="nav-link {{ request()->is('admin/profil_alumni*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate nav-icon"></i>
                        <p>Profil Alumni</p>
                    </a>
                </li>

                <!-- Pengumuman -->
                <li class="nav-item">
                    <a href="{{ route('admin.pengumuman.index') }}" class="nav-link {{ request()->is('admin/pengumuman*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn nav-icon"></i>
                        <p>Pengumuman</p>
                    </a>
                </li>

                <!-- Kategori -->
                <li class="nav-item">
                    <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}">
                        <i class="fas fa-tags nav-icon"></i>
                        <p>Kategori</p>
                    </a>
                </li>

                <!-- Daftar Pemesanan Kelas -->
                <li class="nav-item">
                    <a href="{{ route('admin.daftar_pemesanan.index') }}" class="nav-link {{ request()->is('admin/daftar_pemesanan*') ? 'active' : '' }}">
                        <i class="fas fa-book-reader nav-icon"></i>
                        <p>Daftar Pemesanan Kelas</p>
                    </a>
                </li>

            <!-- Logout -->
            <li class="nav-item">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                    <i class="fas fa-power-off nav-icon"></i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->

      </div>
    <!-- /.sidebar -->
  </aside>
