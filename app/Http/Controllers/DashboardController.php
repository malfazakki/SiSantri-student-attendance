<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Santri;
use App\Models\SesiAbsen;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index() {
        $totalSantri = Santri::count();
        $totalSesiAktif = SesiAbsen::where('aktif', true)->count();

        // Calculate today's attendance percentage
        $today = now()->toDateString();
        $totalAbsensiHariIni = Absensi::where('tanggal', $today)->count();
        $totalHadir = Absensi::where('tanggal', $today)
            ->where('status', 'hadir')
            ->count();

        $kehadiranHariIni = $totalAbsensiHariIni > 0 ? round(($totalHadir / $totalAbsensiHariIni) * 100) : 0;

        // Get recent attendance records
        $recentAbsensis = Absensi::with(['santri', 'sesiAbsen'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('totalSantri', 'totalSesiAktif', 'kehadiranHariIni', 'recentAbsensis'));
    }
}
