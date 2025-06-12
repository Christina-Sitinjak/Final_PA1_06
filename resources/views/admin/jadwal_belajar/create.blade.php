<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
    <title>Tambah Jadwal Belajar Baru (Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .main-wrapper {
            padding: 20px 30px 30px 260px; /* menyesuaikan sidebar */
            min-height: 100vh;
            box-sizing: border-box;
        }

        .card-header {
            background-color: #e3f2fd;
            font-weight: bold;
            font-size: 1.25rem;
            color: #333;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    @include('admin.navbar')
    @include('admin.sidebar')
    <div class="main-wrapper">
        <div class="card shadow">
            <div class="card-header">
                Tambah Jadwal Belajar Baru
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.jadwal_belajar.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori:</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->kategori_id }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program:</label>
                        <select name="program_id" id="program_id" class="form-control">
                            <option value="">Pilih Program</option>
                            @if(isset($programs))
                                @foreach($programs as $program)
                                    <option value="{{ $program->program_id }}">{{ $program->nama_program }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <input type="text" class="form-control" id="hari" name="hari" value="{{ old('hari') }}">
                    </div>

                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}">
                    </div>

                    <div class="mb-3">
                        <label for="jam_berakhir" class="form-label">Jam Berakhir</label>
                        <input type="time" class="form-control" id="jam_berakhir" name="jam_berakhir" value="{{ old('jam_berakhir') }}">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <a href="{{ route('admin.jadwal_belajar.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
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
        });
    </script>
</body>
</html>
