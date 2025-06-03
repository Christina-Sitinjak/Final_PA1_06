<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('user.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column min-vh-100">

            <!-- Main Content -->
            <div id="content" class="flex-grow-1">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    @include('user.navbar')
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Informasi Pemesanan -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-info">
                                    <h6 class="m-0 font-weight-bold text-white">Informasi Pemesanan Kelas UEC</h6>
                                </div>
                                <div class="card-body">
                                    <p><strong>Informasi Pemesanan:</strong></p>
                                    <ul>
                                        <li>Setiap akun hanya diperbolehkan memilih <strong>satu kategori</strong>: Reguler atau Private.</li>
                                        <li>Setiap program hanya boleh dipesan <strong>satu kali</strong>.</li>
                                        <li>Khusus kategori Reguler, diperbolehkan memesan <strong>dua kali</strong> dengan jadwal berbeda.</li>
                                        <li>Pemesanan dapat <strong>diedit</strong> atau <strong>dibatalkan</strong> selama belum disetujui oleh pihak UEC Laguboti.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Reguler Class -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 bg-primary">
                                    <h6 class="m-0 font-weight-bold text-white">Kategori: Reguler Class</h6>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Program</th>
                                                <th>Untuk Siswa Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>Primary</td><td>SD Kelas 3 & 4</td></tr>
                                            <tr><td>Elementary</td><td>SD Kelas 5 & 6</td></tr>
                                            <tr><td>Advance</td><td>SMP Kelas 7, 8 & 9</td></tr>
                                            <tr><td>Special Conversation (SPC)</td><td>SMA Kelas 10, 11 & 12</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Private Class -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3 bg-success">
                                    <h6 class="m-0 font-weight-bold text-white">Kategori: Private Class</h6>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Program</th>
                                                <th>Untuk Siswa Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>Primary</td><td>SD Kelas 3 & 4</td></tr>
                                            <tr><td>Elementary</td><td>SD Kelas 5 & 6</td></tr>
                                            <tr><td>Advance</td><td>SMP Kelas 7, 8 & 9</td></tr>
                                            <tr><td>Special Conversation (SPC)</td><td>SMA Kelas 10, 11 & 12</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('user.footer')
            <!-- End of Footer -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- JS Scripts -->
    <script src="{{ asset('user/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('user/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('user/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('user/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('user/js/demo/chart-pie-demo.js') }}"></script>

</body>
</html>
