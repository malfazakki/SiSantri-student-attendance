<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\Santri;
use App\Models\SesiAbsen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller {
    /**
     * Display the attendance form.
     */
    public function index() {
        $sesiAbsens = SesiAbsen::where('aktif', true)->get();
        $angkatans = Angkatan::all();
        $jurusans = Jurusan::all();
        return view('absensi.index', compact('sesiAbsens', 'angkatans', 'jurusans'));
    }

    /**
     * Show the form for taking attendance.
     */
    public function create(Request $request) {
        $request->validate([
            'sesi_absen_id' => 'required|exists:sesi_absens,id',
            'tanggal' => 'required|date',
            'angkatan_id' => 'nullable|exists:angkatans,id',
            'jurusan_id' => 'nullable|exists:jurusans,id',
        ]);

        $sesiAbsen = SesiAbsen::findOrFail($request->sesi_absen_id);
        $tanggal = $request->tanggal;

        // Get santri with filters
        $santrisQuery = Santri::with(['angkatan', 'jurusan']);

        if ($request->filled('angkatan_id')) {
            $santrisQuery->where('angkatan_id', $request->angkatan_id);
        }

        if ($request->filled('jurusan_id')) {
            $santrisQuery->where('jurusan_id', $request->jurusan_id);
        }

        $santris = $santrisQuery->get();

        // Get existing attendance records for the selected session and date
        $existingAbsensis = Absensi::where('sesi_absen_id', $request->sesi_absen_id)
            ->where('tanggal', $tanggal)
            ->get()
            ->keyBy('santri_id');

        return view('absensi.create', compact('sesiAbsen', 'tanggal', 'santris', 'existingAbsensis'));
    }

    /**
     * Store attendance records
     */
    public function store(Request $request) {
        $request->validate([
            'sesi_absen_id' => 'required|exists:sesi_absens,id',
            'tanggal' => 'required|date',
            'status' => 'required|array',
            'status.*' => 'required|in:hadir,izin,sakit,alfa,piket'
        ]);

        $sesiAbsenId = $request->sesi_absen_id;
        $tanggal = $request->tanggal;
        $mentorId = Auth::guard('mentor')->id();

        // Process each santri's attendance
        foreach ($request->status as $santriId => $status) {
            Absensi::updateOrCreate(
                [
                    'santri_id' => $santriId,
                    'sesi_absen_id' => $sesiAbsenId,
                    'tanggal' => $tanggal,
                ],
                [
                    'mentor_id' => $mentorId,
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil disimpan');
    }

    /**
     * Display attendance history.
     */
    public function history(Request $request) {
        $sesiAbsens = SesiAbsen::all();
        $query = Absensi::with(['santri', 'sesiAbsen', 'mentor']);

        // Apply filter if provided
        if ($request->filled('sesi_absen_id')) {
            $query->where('sesi_absen_id', $request->sesi_absen_id);
        }

        $absensis = $query->latest()->paginate(20);

        return view('absensi.history', compact('absensis', 'sesiAbsens'));
    }
}
