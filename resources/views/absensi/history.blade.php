@extends('layouts.app')

@section('title', 'Riwayat Absensi - SiSantri')

@section('header', 'Riwayat Absensi')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <div>
        <h3 class="text-lg font-semibold">Riwayat Absensi</h3>
        <p class="text-sm text-gray-500">Lihat dan filter riwayat absensi santri</p>
    </div>
    <a href="{{ route('absensi.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">
        Isi Absensi
    </a>
</div>

<div class="bg-white p-6 rounded-lg shadow mb-6">
    <form action="{{ route('absensi.history') }}" method="GET">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="sesi_absen_id" class="block text-sm font-medium text-gray-700 mb-2">Sesi</label>
                <select name="sesi_absen_id" id="sesi_absen_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Sesi</option>
                    @foreach($sesiAbsens as $sesi)
                        <option value="{{ $sesi->id }}" {{ request('sesi_absen_id') == $sesi->id ? 'selected' : '' }}>{{ $sesi->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Filter</button>
                @if(request('sesi_absen_id') || request('tanggal'))
                    <a href="{{ route('absensi.history') }}" class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md">Reset</a>
                @endif
            </div>
        </div>
    </form>
</div>

<div class="bg-white p-6 rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Santri</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sesi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mentor</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($absensis as $absensi)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $absensi->santri->nama }} ({{ $absensi->santri->nis }})</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $absensi->sesiAbsen->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 {{ $absensi->status === 'hadir' ? 'bg-green-100 text-green-800' : ($absensi->status === 'izin' || $absensi->status === 'sakit' || $absensi->status === 'piket_dapur' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }} rounded-full text-xs">
                            {{ ucfirst($absensi->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $absensi->mentor->nama }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data absensi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $absensis->links() }}
    </div>
</div>
@endsection
