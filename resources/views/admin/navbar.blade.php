<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Nama Aplikasi</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <!-- Form Logout dengan logo dan ikon admin -->
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
            @csrf  <!-- Penting untuk CSRF protection -->
            <button type="submit" class="btn-logout">
                <!-- Menambahkan logo admin yang lebih besar -->
                <img src="/img/ueclogo.png" alt="Logo Admin" class="logout-logo">  <!-- Ganti path logo sesuai dengan lokasi file logo -->
                <span>Logout</span>  <!-- Memindahkan teks ke baris bawah -->
            </button>
          </form>
        </li>
      </ul>
    </div>
</nav>


<style>
    /* Styling tombol logout */
/* Tombol logout dengan desain menarik */
.btn-logout {
    background-color: #343a40;  /* Warna abu-abu gelap untuk tombol */
    color: white;
    border: none;
    font-size: 18px;
    padding: 12px 30px;
    border-radius: 50px;  /* Membuat tombol melengkung */
    display: flex;
    align-items: center;
    transition: all 0.3s ease;  /* Efek transisi */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);  /* Menambahkan bayangan lembut */
}

/* Hover effect dengan perubahan warna dan efek bayangan */
.btn-logout:hover {
    background-color: #23272b;  /* Warna abu-abu lebih gelap saat hover */
    color: #fff;
    transform: translateY(-5px);  /* Efek melayang sedikit saat hover */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.25);  /* Efek bayangan lebih tajam */
}

/* Efek saat tombol logout aktif atau saat klik */
.btn-logout:focus {
    outline: none;  /* Menghilangkan outline default */
    box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.5);  /* Menambahkan efek focus */
}

/* Ikon logout */
.btn-logout i {
    font-size: 20px; /* Ukuran ikon lebih besar */
    margin-left: 10px;  /* Memberikan jarak antara ikon dan teks */
}

/* Animasi tombol logout untuk menarik perhatian */
.btn-logout:hover i {
    transform: rotate(15deg);  /* Rotasi ikon saat hover */
}

/* Gaya untuk logo admin di tombol logout */
.logout-logo {
    width: 35px;  /* Ukuran logo lebih besar */
    height: 35px;  /* Ukuran logo lebih besar */
    margin-right: 12px;  /* Memberikan jarak antara logo dan teks */
    border-radius: 50%;  /* Membuat logo menjadi bulat */
}

</style>

