<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
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

        return view('absensi.index', compact('sesiAbsens'));
    }

    /**
     * Show the form for taking attendance.
     */
    public function create(Request $request) {
        $request->validate([
            'sesi_absen_id' => 'required|exists:sesi_absens,id',
            'tanggal' => 'required|date',
        ]);

        $sesiAbsen = SesiAbsen::findOrFail($request->sesi_absen_id);
        $tanggal = $request->tanggal;

        // Get all santri
        $santris = Santri::with(['angkatan', 'jurusan'])->get();

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
