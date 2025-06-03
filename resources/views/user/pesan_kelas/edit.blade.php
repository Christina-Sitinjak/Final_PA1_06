<!DOCTYPE html>
<html>
<head>
    @include('user.head')
    <title>Edit Pemesanan Kelas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            overflow-x: hidden;
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h1 {
            color: #343a40;
            font-weight: bold;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #4a90e2;
            border-color: #4a90e2;
        }

        .btn-primary:hover {
            background-color: #357abd;
            border-color: #357abd;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .form-group label {
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .card {
                padding: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="d-flex">
    <!-- Sidebar -->
    @include('user.sidebar')

    <!-- Main Content -->
    <div class="flex-grow-1 p-4 bg-light min-vh-100 overflow-auto">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1 class="mb-4">Edit Pemesanan Kelas</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.pesan_kelas.update', $pesanKelas->pesan_kelas_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $pesanKelas->nama) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pesanKelas->alamat) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="asal_sekolah">Asal Sekolah:</label>
                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $pesanKelas->asal_sekolah) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="kategori_id">Kategori:</label>
                <select class="form-control" id="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->kategori_id }}" {{ old('kategori_id', $pesanKelas->program->category->kategori_id) == $category->kategori_id ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="tingkatan">Tingkatan:</label>
                <select class="form-control" id="tingkatan" name="tingkatan" required>
                    <option value="">Pilih Tingkatan</option>
                    <option value="sd" {{ old('tingkatan', $pesanKelas->tingkatan) == 'sd' ? 'selected' : '' }}>SD</option>
                    <option value="smp" {{ old('tingkatan', $pesanKelas->tingkatan) == 'smp' ? 'selected' : '' }}>SMP</option>
                    <option value="sma" {{ old('tingkatan', $pesanKelas->tingkatan) == 'sma' ? 'selected' : '' }}>SMA</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="kelas">Kelas:</label>
                <select class="form-control" id="kelas" name="kelas" required>
                    <option value="">Pilih Kelas</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="program_id">Program:</label>
                <select class="form-control" id="program_id" name="program_id" required>
                    <option value="">Pilih Program</option>
                </select>
            </div>

            <div id="jadwal-container" class="form-group">
                <label for="jadwal">Jadwal:</label>
                <div id="jadwal-options"></div>
            </div>

            <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user.pesan_kelas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
            </div>
        </div>
    </div>
</div>


    <script>
        $(document).ready(function() {
            $('#tingkatan').change(function() {
                var tingkatan = $(this).val();
                var kelasOptions = '<option value="">Pilih Kelas</option>';
                if (tingkatan === 'sd') {
                    for (var i = 1; i <= 6; i++) {
                        kelasOptions += '<option value="' + i + '">' + i + '</option>';
                    }
                } else if (tingkatan === 'smp') {
                    for (var i = 7; i <= 9; i++) {
                        kelasOptions += '<option value="' + i + '">' + i + '</option>';
                    }
                } else if (tingkatan === 'sma') {
                    for (var i = 10; i <= 12; i++) {
                        kelasOptions += '<option value="' + i + '">' + i + '</option>';
                    }
                }
                $('#kelas').html(kelasOptions);

                   // Set selected value when editing
                $('#kelas').val("{{ old('kelas', $pesanKelas->kelas) }}");
            });

    // Trigger change event on pageload
    $('#tingkatan').trigger('change');

    function loadPrograms(kategoriId) {
        if (kategoriId) {
            $.ajax({
                url: "{{ route('getPrograms') }}",
                type: "GET",
                data: { kategori_id: kategoriId },
                dataType: "json",
                success: function(data) {
                    var programOptions = '<option value="">Pilih Program</option>';
                    $.each(data, function(key, value) {
                        programOptions += '<option value="' + value.program_id + '">' + value.nama_program + '</option>';
                    });
                    $('#program_id').html(programOptions);
                    // Set selected value when editing
                    $('#program_id').val("{{ old('program_id', $pesanKelas->program_id) }}");
                }
            });
        } else {
            $('#program_id').html('<option value="">Pilih Program</option>');
        }
    }

    $('#kategori_id').change(function() {
        var kategoriId = $(this).val();
        loadPrograms(kategoriId);
    });

    // Load programs on page load
    loadPrograms($('#kategori_id').val());
});

    function loadJadwal(kategoriText) {
        var jadwalHtml = '';
        var selectedJadwal = "{{ old('jadwal', $pesanKelas->jadwal) }}";

        if (kategoriText.toLowerCase() === 'reguler class') {
            jadwalHtml += '<div><input type="radio" id="senin_rabu" name="jadwal" value="Senin-Rabu" ' + (selectedJadwal === 'Senin-Rabu' ? 'checked' : '') + '> <label for="senin_rabu">Senin-Rabu</label></div>';
            jadwalHtml += '<div><input type="radio" id="selasa_kamis" name="jadwal" value="Selasa-Kamis" ' + (selectedJadwal === 'Selasa-Kamis' ? 'checked' : '') + '> <label for="selasa_kamis">Selasa-Kamis</label></div>';
        } else if (kategoriText.toLowerCase() === 'private class') {
            jadwalHtml += '<div><input type="radio" id="jumat_sabtu" name="jadwal" value="Jumat-Sabtu" ' + (selectedJadwal === 'Jumat-Sabtu' ? 'checked' : '') + '> <label for="jumat_sabtu">Jumat-Sabtu</label></div>';
        } else {
            jadwalHtml = '<div class="text-muted">Pilih kategori untuk melihat jadwal</div>';
        }

        $('#jadwal-options').html(jadwalHtml);
    }

    // Trigger saat kategori berubah
    $('#kategori_id').change(function() {
        var kategoriText = $('#kategori_id option:selected').text();
        loadJadwal(kategoriText);
    });

    // Trigger juga saat halaman pertama kali load
    loadJadwal($('#kategori_id option:selected').text());

    </script>
</body>
</html>
