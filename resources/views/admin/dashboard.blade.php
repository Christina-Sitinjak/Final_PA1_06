<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.head')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN UEC | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{URL::asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{URL::asset('plugins/summernote/summernote-bs4.min.css')}}">
  <!-- Custom Styles -->
  <style>
    /* Add some spacing between the cards */
    .small-box {
        margin-bottom: 20px; /* Add bottom margin */
    }

    /* Add custom padding to the row inside the container */
    .content-wrapper {
        padding-left: 20px;
        padding-right: 20px;
    }

    /* Responsive styling for dashboard cards */
    @media (max-width: 768px) {
        .small-box {
            margin-bottom: 15px; /* Less space between cards on smaller screens */
        }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<!-- Navbar -->
@include('admin.navbar')
<!-- Main Sidebar Container -->
@include('admin.sidebar')
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
          <!-- Kelas -->
          <div class="col-lg-3 col-md-6 col-12">
              <div class="small-box bg-primary">
                  <div class="inner">
                      <h3>{{ $jumlahKelas }}</h3>
                      <p>Kelas</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-book"></i>
                  </div>
                  <a href="{{ route('admin.kelas.index') }}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>

          <!-- Galeri -->
          <div class="col-lg-3 col-md-6 col-12">
              <div class="small-box bg-purple">
                  <div class="inner">
                      <h3>{{ $jumlahGaleri }}</h3>
                      <p>Galeri</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-image"></i>
                  </div>
                  <a href="{{ route('admin.galeri.index') }}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>

          <!-- Pengajar -->
          <div class="col-lg-3 col-md-6 col-12">
              <div class="small-box bg-success">
                  <div class="inner">
                      <h3>{{ $jumlahPengajar }}</h3>
                      <p>Pengajar</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-chalkboard-teacher"></i>
                  </div>
                  <a href="{{ route('admin.pengajar.index') }}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>

          <!-- Alumni -->
          <div class="col-lg-3 col-md-6 col-12">
              <div class="small-box bg-warning">
                  <div class="inner">
                      <h3>{{ $jumlahAlumni }}</h3>
                      <p>Alumni</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-user-graduate"></i>
                  </div>
                  <a href="{{ route('admin.profil_alumni.index') }}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>

          <!-- Pengumuman -->
          <div class="col-lg-3 col-md-6 col-12">
              <div class="small-box bg-danger">
                  <div class="inner">
                      <h3>{{ $jumlahPengumuman }}</h3>
                      <p>Pengumuman</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-bullhorn"></i>
                  </div>
                  <a href="{{ route('admin.pengumuman.index') }}" class="small-box-footer">
                      More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
              </div>
          </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('dist/js/adminlte.js')}}"></script>

</body>
</html>
