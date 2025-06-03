<!DOCTYPE html>
<html>
<head>
    @include('user.head')
    <title>Pesan Kelas</title>
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
<body class="d-flex">  <!-- Tambahkan class d-flex di sini -->

    <!-- Sidebar -->
    @include('user.sidebar')

    <!-- Main Content -->
    <div class="flex-grow-1 p-4 bg-light min-vh-100 overflow-auto">
        <div class="bg-white p-4 rounded shadow-sm">
            <h1>Pesan Kelas</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <form action="{{ route('user.pesan_kelas.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="asal_sekolah">Asal Sekolah:</label>
                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kategori_id">Kategori:</label>
                        <select class="form-control" id="kategori_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->kategori_id }}" {{ old('kategori_id') == $category->kategori_id ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tingkatan">Tingkatan:</label>
                        <select class="form-control" id="tingkatan" name="tingkatan" required>
                            <option value="">Pilih Tingkatan</option>
                            <option value="sd" {{ old('tingkatan') == 'sd' ? 'selected' : '' }}>SD</option>
                            <option value="smp" {{ old('tingkatan') == 'smp' ? 'selected' : '' }}>SMP</option>
                            <option value="sma" {{ old('tingkatan') == 'sma' ? 'selected' : '' }}>SMA</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas:</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            <option value="">Pilih Kelas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="program_id">Program:</label>
                        <select class="form-control" id="program_id" name="program_id" required>
                            <option value="">Pilih Program</option>
                        </select>
                    </div>

                    <div id="jadwal-container" class="form-group">
                        <label for="jadwal">Jadwal:</label>
                        <div id="jadwal-options"></div>
                    </div>

                    <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                        <button type="submit" class="btn btn-primary">Pesan</button>
                        <button type="button" class="btn btn-secondary" onclick="batalPesan()">Cancel</button>
                    </div>
                </form>
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
            });

            $('#kategori_id').change(function() {
                var kategoriId = $(this).val();
                var kategoriText = $("#kategori_id option:selected").text();

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
                        }
                    });
                } else {
                    $('#program_id').html('<option value="">Pilih Program</option>');
                }

                var jadwalHtml = '';
                if (kategoriText.toLowerCase() === 'reguler class') {
                    jadwalHtml += '<div><input type="radio" id="senin_rabu" name="jadwal" value="Senin-Rabu" required> <label for="senin_rabu">Senin-Rabu</label></div>';
                    jadwalHtml += '<div><input type="radio" id="selasa_kamis" name="jadwal" value="Selasa-Kamis" required> <label for="selasa_kamis">Selasa-Kamis</label></div>';
                } else if (kategoriText.toLowerCase() === 'private class') {
                    jadwalHtml += '<div><input type="radio" id="jumat_sabtu" name="jadwal" value="Jumat-Sabtu" required> <label for="jumat_sabtu">Jumat-Sabtu</label></div>';
                }
                $('#jadwal-options').html(jadwalHtml);
            });

            if ($('#tingkatan').val() !== '') {
                $('#tingkatan').trigger('change');
                const selectedKelas = "{{ old('kelas') }}";
                setTimeout(function () {
                    if (selectedKelas !== '') {
                        $('#kelas').val(selectedKelas);
                    }
                }, 100);
            }

            const oldKategoriId = "{{ old('kategori_id') }}";
            const oldProgramId = "{{ old('program_id') }}";
            if (oldKategoriId !== '') {
                $('#kategori_id').val(oldKategoriId).trigger('change');
                setTimeout(function () {
                    $('#program_id').val(oldProgramId);
                }, 300);
            }
        });

        function batalPesan() {
            if (confirm('Yakin batal pesan?')) {
                window.location.href = '{{ route('user.pesan_kelas.index') }}';
            }
        }
    </script>
</body>
</html>
