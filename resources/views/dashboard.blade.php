@extends('layouts.app')

@section('title', 'Dashboard - SiSantri')

@section('header', 'Dashboard')

@section('content')
    <!-- Section Cards -->
    <div class="grid cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500">Total Santri</h3>
            <p class="text-3xl font-bold">{{ $totalSantri }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500">Kehadiran Santri</h3>
            <p class="text-3xl font-bold">{{ $kehadiranHariIni }}%</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500">Sesi Aktif</h3>
            <p class="text-3xl font-bold">{{ $totalSesiAktif }}</p>
        </div>
    </div>

    {{-- Recent Attendance --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Absensi Terakhir</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sesi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentAbsensis as $absensi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $absensi->santri->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $absensi->sesiAbsen->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 {{ $absensi->status === 'hadir' ? 'bg-green-100 text-green-800' : ($absensi->status === 'izin' || $absensi->status === 'sakit' || $absensi->status === 'piket' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }} rounded-full text-xs">{{ ucfirst($absensi->status) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $absensi->created_at->format('H:i, d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
