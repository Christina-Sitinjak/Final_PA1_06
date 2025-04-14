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
                <!-- Kelas -->
                <li class="nav-item">
                    <a href="{{ route('admin.kelas.index') }}" class="nav-link {{ request()->is('admin/kelas*') ? 'active' : '' }}">
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
            </ul>
        </li>

        <!-- Daftar Kelas -->
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book-reader"></i> <!-- Ganti ikon dengan buku -->
                <p>
                    Daftar Kelas
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
        </li>

        <!-- Tables -->
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Tables
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->

      </div>
    <!-- /.sidebar -->
  </aside>
