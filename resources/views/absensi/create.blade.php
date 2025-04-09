@extends('layouts.app')

@section('title', 'Isi Absensi - SiSantri')

@section('header', 'Isi Absensi Santri')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <div>
        <h3 class="text-lg font-semibold">Absensi: {{ $sesiAbsen->nama }} - {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</h3>
        <p class="text-sm text-gray-500">Pilih status kehadiran untuk setiap santri</p>
    </div>
    <a href="{{ route('absensi.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md">
        Kembali
    </a>
</div>

<div class="bg-white p-6 rounded-lg shadow">
    <form action="{{ route('absensi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="sesi_absen_id" value="{{ $sesiAbsen->id }}">
        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Angkatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($santris as $santri)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $santri->nis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $santri->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $santri->angkatan->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $santri->jurusan->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select name="status[{{ $santri->id }}]" class="px-2 py-1 border rounded-md w-full">
                                <option value="hadir" {{ isset($existingAbsensis[$santri->id]) && $existingAbsensis[$santri->id]->status === 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="izin" {{ isset($existingAbsensis[$santri->id]) && $existingAbsensis[$santri->id]->status === 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ isset($existingAbsensis[$santri->id]) && $existingAbsensis[$santri->id]->status === 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="alfa" {{ isset($existingAbsensis[$santri->id]) && $existingAbsensis[$santri->id]->status === 'alfa' ? 'selected' : '' }}>Alfa</option>
                                <option value="piket_dapur" {{ isset($existingAbsensis[$santri->id]) && $existingAbsensis[$santri->id]->status === 'piket_dapur' ? 'selected' : '' }}>Piket Dapur</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('absensi.index') }}" class="px-4 py-2 border border-gray-300 rounded-md mr-2">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Simpan Absensi</button>
        </div>
    </form>
</div>
@endsection
