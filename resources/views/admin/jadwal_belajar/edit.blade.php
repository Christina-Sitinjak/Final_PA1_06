<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Edit Jadwal Belajar (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            padding: 20px 30px 30px 260px; /* space for sidebar */
        }

        .card {
            margin-top: 1rem;
        }

        .card-header {
            background-color: #e3f2fd;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
        }

        .card-header .btn {
            margin-left: auto;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-hapus {
            background-color: #c9c014;
            color: white;
        }

        .btn-edit:hover,
        .btn-hapus:hover {
            opacity: 0.9;
        }

        th, td {
            vertical-align: middle !important;
            text-align: center;
        }

        .table {
            font-size: 0.95rem;
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
                <span>Edit Jadwal Belajar</span>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.jadwal_belajar.update', $jadwalBelajar->jadwal_belajar_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori:</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->kategori_id }}" {{ (isset($programs) && $programs->isNotEmpty() && $programs->first()->category->kategori_id == $category->kategori_id) ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program:</label>
                        <select name="program_id" id="program_id" class="form-control">
                            <option value="">Pilih Program</option>
                            @if(isset($programs))
                                @foreach($programs as $program)
                                    <option value="{{ $program->program_id }}" {{ $program->program_id == $jadwalBelajar->program_id ? 'selected' : '' }}>{{ $program->nama_program }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari:</label>
                        <input type="text" class="form-control" id="hari" name="hari" value="{{ $jadwalBelajar->hari }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai:</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ $jadwalBelajar->jam_mulai }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="jam_berakhir" class="form-label">Jam Berakhir:</label>
                        <input type="time" class="form-control" id="jam_berakhir" name="jam_berakhir" value="{{ $jadwalBelajar->jam_berakhir }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.jadwal_belajar.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kategori_id').change(function() {
                var kategoriId = $(this).val();
                if (kategoriId) {
                    $.ajax({
                        url: '{{ route('admin.jadwal_belajar.getPrograms') }}',
                        type: "GET",
                        data: { kategori_id: kategoriId },
                        dataType: "json",
                        success: function(data) {
                            $('#program_id').empty();
                            $('#program_id').append('<option value="">Pilih Program</option>');
                            $.each(data, function(key, value) {
                                $('#program_id').append('<option value="' + value.program_id + '">' + value.nama_program + '</option>');
                            });
                        }
                    });
                } else {
                    $('#program_id').empty();
                    $('#program_id').append('<option value="">Pilih Program</option>');
                }
            });

            // Set selected program on page load
            var kategoriId = $('#kategori_id').val();
            if (kategoriId) {
                $.ajax({
                    url: '{{ route('admin.jadwal_belajar.getPrograms') }}',
                    type: "GET",
                    data: { kategori_id: kategoriId },
                    dataType: "json",
                    success: function(data) {
                        $('#program_id').empty();
                        $('#program_id').append('<option value="">Pilih Program</option>');
                        $.each(data, function(key, value) {
                            var isSelected = (value.program_id == '{{ $jadwalBelajar->program_id }}') ? 'selected' : '';
                            $('#program_id').append('<option value="' + value.program_id + '" ' + isSelected + '>' + value.nama_program + '</option>');
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>
