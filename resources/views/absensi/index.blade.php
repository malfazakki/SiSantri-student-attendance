@extends('layouts.app')

@section('title', 'Absensi - SiSantri')

@section('header', 'Absensi Santri')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <div>
            <h3 class="text-lg font-semibold">Form Absensi</h3>
            <p class="text-sm text-gray-500">Pilih sesi dan tanggal untuk melakukan absensi</p>
        </div>
        <a href="{{ route('absensi.history') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md">
            Lihat Riwayat
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('absensi.create') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="sesi_absen_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Sesi</label>
                    <select name="sesi_absen_id" id="sesi_absen_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">Pilih Sesi</option>
                        @foreach ($sesiAbsens as $sesi)
                            <option value="{{ $sesi->id }}">{{ $sesi->nama }}
                                ({{ \Carbon\Carbon::parse($sesi->waktu)->format('H:i') }})</option>
                        @endforeach
                    </select>
                    @error('sesi_absen_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @error('tanggal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Lanjutkan</button>
            </div>
        </form>
    </div>
@endsection
