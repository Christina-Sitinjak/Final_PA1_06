<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Daftar Pemesanan Kelas (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            padding: 20px 30px 30px 260px; /* space for sidebar on left */
        }

        .card {
            margin-top: 1rem;
            border: none;
            border-radius: 12px;
        }
        .card-header .btn {
            margin-left: auto;
        }
        .card-header {
            background-color: #e3f2fd;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .table th, .table td {
            vertical-align: middle !important;
            text-align: center;
        }


        .btn-approve {
            background-color: #28a745;
            color: white;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: white;
        }

        .btn-approve:hover, .btn-cancel:hover {
            opacity: 0.9;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    @include('admin.navbar')
    @include('admin.sidebar')
    <div class="main-wrapper">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Daftar Pemesanan Kelas</span>
                <!-- Tambahkan tombol jika perlu -->
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            <div class="row mb-3">
                <div class="col">
                    <div class="alert alert-success">✅ Total Approved: {{ $summary['approved'] }}</div>
                </div>
                <div class="col">
                    <div class="alert alert-warning">🕐 Total Pending: {{ $summary['pending'] }}</div>
                </div>
                <div class="col">
                    <div class="alert alert-danger">❌ Total Cancelled: {{ $summary['cancelled'] }}</div>
                </div>
            </div>


            <form method="GET" action="{{ route('admin.daftar_pemesanan.index') }}" class="row mb-3">
                <div class="col-md-3">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($semua_kategori as $kategori)
                            <option value="{{ $kategori->kategori_id }}" {{ request('category') == $kategori->kategori_id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="program" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Program</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->nama_program }}" {{ request('program') == $program->nama_program ? 'selected' : '' }}>
                                {{ $program->nama_program }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                </div>
            </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Nama Murid</th>
                                <th>Kategori</th>
                                <th>Program</th>
                                <th>Jadwal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanans as $pesanan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pesanan->user->name }}</td>
                                    <td>{{ $pesanan->nama }}</td>
                                    <td>{{ $pesanan->program->category->nama_kategori }}</td>
                                    <td>{{ $pesanan->program->nama_program}}</td>
                                    <td>{{ $pesanan->jadwal }}</td>
                                    <td>{{ $pesanan->status }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            @if($pesanan->status == 'pending')
                                                <form action="{{ route('admin.daftar_pemesanan.approve', $pesanan->pesan_kelas_id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-approve">
                                                        <i class="bi bi-check-circle me-1"></i> Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.daftar_pemesanan.cancel', $pesanan->pesan_kelas_id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-cancel">
                                                        <i class="bi bi-x-circle me-1"></i> Tolak
                                                    </button>
                                                </form>
                                            @else
                                                Sudah Diproses
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Tidak ada pemesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

<script>
$(document).ready(function() {
    var selectedProgram = '{{ request("program") }}';

    $('select[name="category"]').on('change', function() {
        var categoryID = $(this).val();
        var programSelect = $('select[name="program"]');

        programSelect.html('<option value="">Loading...</option>');

        $.ajax({
            url: '{{ route("getProgramByCategory") }}',
            type: 'GET',
            data: { category: categoryID },
            success: function(data) {
                programSelect.empty();
                programSelect.append('<option value="">Semua Program</option>');

                $.each(data, function(index, program) {
                    const selected = program.nama_program === selectedProgram ? 'selected' : '';
                    programSelect.append(`<option value="${program.nama_program}" ${selected}>${program.nama_program}</option>`);
                });
            }
        });
    });

    // Trigger pemuatan ulang program jika ada kategori yang terpilih saat load
    if ($('select[name="category"]').val()) {
        $('select[name="category"]').trigger('change');
    }
});

</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
