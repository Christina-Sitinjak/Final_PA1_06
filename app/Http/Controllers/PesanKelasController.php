<?php

namespace App\Http\Controllers;

use App\Models\PesanKelas;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PesanKelasController extends Controller
{
    /**
     * Display a listing of the resource for the user.
     */
    public function showApproved(PesanKelas $pesanKelas)
    {
        // Eager load relasi kategori dan program (penting untuk menghindari N+1 query)
        $pesanKelas = $pesanKelas->load('program.category');

        // Pastikan hanya menampilkan data jika statusnya "approved"
        if ($pesanKelas->status !== 'approved') {
            abort(403, 'Akses ditolak. Pemesanan belum disetujui.'); // Atau redirect ke halaman lain
        }

        return view('user.pesan_kelas.show_approved', compact('pesanKelas'));
    }

    public function index()
    {
        $user = Auth::user();
        $pesanKelas = PesanKelas::where('user_id', $user->id)->latest()->paginate(10); // Hanya menampilkan pemesanan user yang login
        $bolehPesan = $this->canCreateNewPemesanan($user->id);
        return view('user.pesan_kelas.index', compact('pesanKelas', 'bolehPesan')); // View untuk dashboard user
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('user.pesan_kelas.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'asal_sekolah' => 'required|string|max:255',
        //'kategori_id' => 'required|exists:categories,kategori_id',
        'tingkatan' => 'required|string|in:sd,smp,sma',
        'kelas' => [
            'required',
            'integer',
            'min:1',
            function ($attribute, $value, $fail) use ($request) {
                $tingkatan = $request->input('tingkatan');
                if (($tingkatan == 'sd' && ($value < 1 || $value > 6)) ||
                    ($tingkatan == 'smp' && ($value < 7 || $value > 9)) ||
                    ($tingkatan == 'sma' && ($value < 10 || $value > 12))) {
                    $fail('Kelas tidak valid untuk tingkatan yang dipilih.');
                }
            },
        ],
        'program_id' => 'required|exists:programs,program_id',
        'jadwal' => [
            'required',
            'string',
            'in:Senin-Rabu,Selasa-Kamis,Jumat-Sabtu',
            function ($attribute, $value, $fail) use ($request) {
                $user = Auth::user();
                $programId = (int) $request->input('program_id');
                $jadwal = $value;

                // Dapatkan kategori_id dari program yang dipilih
                $program = Program::find($programId);
                if (!$program) {
                    $fail('Program tidak valid.');
                    return;
                }
                $kategoriId = $program->kategori_id;

                $pemesananSebelumnya = PesanKelas::where('user_id', $user->id)
        ->whereIn('status', ['pending', 'approved']) // Hanya ambil pemesanan pending atau approved
        ->get();

                if ($pemesananSebelumnya->count() > 0) {
                    $first = $pemesananSebelumnya->first();

                    // Dapatkan kategori_id dari program yang dipesan sebelumnya
                    $kategoriIdSebelumnya = $first->program->kategori_id;

                    // Cegah ganti kategori
                    if ($kategoriIdSebelumnya != $kategoriId) {
                        $fail('Anda sudah memesan kategori berbeda. Tidak diperbolehkan memesan lebih dari 1 kategori.');
                        return;
                    }

                    if ($kategoriId == 2) { // Privat
                        $fail('Kategori Privat hanya boleh dipesan sekali.');
                        return;
                    }

                    if ($kategoriId == 1) { // Reguler
                        $sama = $pemesananSebelumnya->where('program_id', $programId)->where('jadwal', $jadwal)->count();
                        if ($sama > 0) {
                            $fail('Anda sudah memesan program ini dengan jadwal yang sama.');
                            return;
                        }

                        // Cek apakah user mencoba memesan program berbeda
                        $programBerbeda = $pemesananSebelumnya->where('program_id', '!=', $programId)->count();
                        if ($programBerbeda > 0) {
                            $fail('Anda hanya bisa memesan program yang sama dengan jadwal berbeda.');
                            return;
                        }

                        // Maksimal 2 pemesanan program yang sama tapi jadwal berbeda
                        $programYangSama = $pemesananSebelumnya->where('program_id', $programId)->count();
                        if ($programYangSama >= 2) {
                            $fail('Anda sudah memesan dua kali program ini dengan jadwal berbeda.');
                            return;
                }
            }
        }

        // Jika kategori Privat, harus jadwal Jumat-Sabtu
        if ($kategoriId == 2 && $jadwal != 'Jumat-Sabtu') {
            $fail('Kategori Privat hanya tersedia di jadwal Jumat-Sabtu.');
            return;
                }
            }
        ]
    ]);

    $program = Program::find($request->input('program_id'));
    if ($program && $program->stok <= 0) {
        $validator->after(function ($validator) {
            $validator->errors()->add('program_id', 'Stok program ini sudah habis.');
        });
    }

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $pesanKelas = new PesanKelas();
    $pesanKelas->user_id = Auth::id();
    $pesanKelas->nama = $request->input('nama');
    $pesanKelas->alamat = $request->input('alamat');
    $pesanKelas->asal_sekolah = $request->input('asal_sekolah');
    //$pesanKelas->kategori_id = $request->input('kategori_id');
    $pesanKelas->tingkatan = $request->input('tingkatan');
    $pesanKelas->kelas = $request->input('kelas');
    $pesanKelas->program_id = $request->input('program_id');
    $pesanKelas->jadwal = $request->input('jadwal');
    $pesanKelas->save();

    $program->decrement('stok', 1);

    return redirect()->route('user.pesan_kelas.index')->with('success', 'Pemesanan kelas berhasil!');
}

    /**
     * Display the specified resource.
     */
    public function show(PesanKelas $pesanKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesanKelas $pesanKelas)
    {
        // Cek apakah user yang login adalah pemilik pemesanan
        if (Auth::id() !== $pesanKelas->user_id) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah pemesanan ini.');
        }

        // Cek apakah status masih "pending"
        if ($pesanKelas->status !== 'pending') {
            return redirect()->route('user.pesan_kelas.index')->with('error', 'Anda tidak dapat mengubah pemesanan yang sudah diproses.');
        }

        $pesanKelas->load('program.category');

        $categories = Category::all();

        // Ambil program berdasarkan kategori yang sudah dipilih
        $programs = Program::where('kategori_id', $pesanKelas->program->kategori_id)->get();

        return view('user.pesan_kelas.edit', compact('pesanKelas', 'categories', 'programs'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PesanKelas $pesanKelas)
    {
        if (Auth::id() !== $pesanKelas->user_id) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah pemesanan ini.');
        }

        if ($pesanKelas->status !== 'pending') {
            return redirect()->route('user.pesan_kelas.index')->with('error', 'Anda tidak dapat mengubah pemesanan yang sudah diproses.');
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            //'kategori_id' => 'required|exists:categories,kategori_id',
            'tingkatan' => 'required|string|in:sd,smp,sma',
            'kelas' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    $kelasRange = [
                        'sd' => [1, 6],
                        'smp' => [7, 9],
                        'sma' => [10, 12],
                    ];
                    $tingkatan = $request->tingkatan;
                    if (isset($kelasRange[$tingkatan])) {
                        [$min, $max] = $kelasRange[$tingkatan];
                        if ($value < $min || $value > $max) {
                            return $fail('Kelas tidak valid untuk tingkatan yang dipilih.');
                        }
                    }
                },
            ],
            'program_id' => 'required|exists:programs,program_id',
            'jadwal' => [
                'required',
                'string',
                'in:Senin-Rabu,Selasa-Kamis,Jumat-Sabtu',
                function ($attribute, $value, $fail) use ($request, $pesanKelas) {
                    $user = Auth::user();
                    $programId = (int) $request->program_id;
                    $jadwal = $value;

                    // Dapatkan kategori_id dari program yang dipilih
                    $program = Program::find($programId);
                    if (!$program) {
                        $fail('Program tidak valid.');
                        return;
                    }
                    $kategoriId = $program->kategori_id;

                    $pemesananSebelumnya = PesanKelas::where('user_id', $user->id)
        ->where('pesan_kelas_id', '!=', $pesanKelas->pesan_kelas_id) // Kecualikan pemesanan yang sedang diubah
        ->whereIn('status', ['pending', 'approved']) // Hanya ambil pemesanan pending atau approved
        ->get();

                    if ($pemesananSebelumnya->count() > 0) {
                        $first = $pemesananSebelumnya->first();

                        // Dapatkan kategori_id dari program yang dipesan sebelumnya
                        $kategoriIdSebelumnya = $first->program->kategori_id;

                        if ($kategoriIdSebelumnya != $kategoriId) {
                            return $fail('Anda sudah memesan kategori berbeda. Tidak diperbolehkan memesan lebih dari 1 kategori.');
                        }

                        if ($kategoriId == 2) {
                            return $fail('Kategori Privat hanya boleh dipesan sekali.');
                        }

                        if ($kategoriId == 1) {
                            $sama = $pemesananSebelumnya->where('program_id', $programId)
                                ->where('jadwal', $jadwal)
                                ->count();

                            if ($sama > 0) {
                                return $fail('Anda sudah memesan program ini dengan jadwal yang sama.');
                            }

                            $programBerbeda = $pemesananSebelumnya->where('program_id', '!=', $programId)->count();
                            if ($programBerbeda > 0) {
                                return $fail('Anda hanya bisa memesan program yang sama dengan jadwal berbeda.');
                            }

                            $programYangSama = $pemesananSebelumnya->where('program_id', $programId)->count();
                            if ($programYangSama >= 2) {
                                return $fail('Anda sudah memesan dua kali program ini dengan jadwal berbeda.');
                }
            }
        }

        if ($kategoriId == 2 && $jadwal != 'Jumat-Sabtu') {
            return $fail('Kategori Privat hanya tersedia di jadwal Jumat-Sabtu.');
                    }
                }
            ]
        ]);

        $program = Program::findOrFail($request->program_id);
        if ($program->stok <= 0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('program_id', 'Stok program ini sudah habis.');
            });
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::transaction(function () use ($request, $pesanKelas) {
            $pesanKelas->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'asal_sekolah' => $request->asal_sekolah,
                //'kategori_id' => $request->kategori_id,
                'tingkatan' => $request->tingkatan,
                'kelas' => $request->kelas,
                'program_id' => $request->program_id,
                'jadwal' => $request->jadwal,
            ]);
        });

        return redirect()->route('user.pesan_kelas.index')->with('success', 'Pemesanan kelas berhasil diperbarui!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesanKelas $pesanKelas)
    {
        // Cek apakah user yang login adalah pemilik pemesanan
        if (Auth::id() !== $pesanKelas->user_id) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus pemesanan ini.');
        }

        // Cek apakah status masih "pending"
        if ($pesanKelas->status !== 'pending') {
            return redirect()->route('user.pesan_kelas.index')->with('error', 'Anda tidak dapat membatalkan pemesanan yang sudah diproses.');
        }

        $program = Program::find($pesanKelas->program_id);
        if ($program) {
            $program->increment('stok', 1);
        }

        $pesanKelas->delete();

        return redirect()->route('user.pesan_kelas.index')->with('success', 'Pemesanan kelas berhasil dibatalkan!');
    }

    /**
     * Get Programs based on selected Category.
     */
    public function getPrograms(Request $request)
    {
        $kategoriId = $request->input('kategori_id');
        $programs = Program::where('kategori_id', $kategoriId)
                         ->where('stok', '>', 0) // Hanya program dengan stok > 0
                         ->get();

        return response()->json($programs);
    }

        /**
     * Cek apakah user masih boleh membuat pemesanan baru.
     */
    public function canCreateNewPemesanan($userId)
    {
        $pemesanan = PesanKelas::where('user_id', $userId)
            ->whereIn('status', ['pending', 'approved'])
            ->with('program.category')
            ->get();

        if ($pemesanan->isEmpty()) {
            return true; // Belum pernah pesan sama sekali
        }

        $first = $pemesanan->first();
        $kategoriId = $first->program->kategori_id;

        if ($kategoriId == 2) {
            return false; // Privat hanya boleh sekali
        }

        if ($kategoriId == 1) {
            $programId = $first->program_id;
            $programYangSama = $pemesanan->where('program_id', $programId)->count();
            $programBerbeda = $pemesanan->where('program_id', '!=', $programId)->count();

            if ($programBerbeda > 0 || $programYangSama >= 2) {
                return false;
            }
        }

        return true;
    }
}
