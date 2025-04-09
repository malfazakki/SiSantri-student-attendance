@extends('layouts.app')

@section('title', 'Tambah Sesi Absen - SiSantri')

@section('header', 'Tambah Sesi Absen')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <form action="{{ route('sesi.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Sesi</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            @error('nama')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="waktu" class="block text-sm font-medium text-gray-700 mb-2">Waktu</label>
            <input type="time" name="waktu" id="waktu" value="{{ old('waktu') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            @error('waktu')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="aktif" value="1" {{ old('aktif') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-600">Aktif</span>
            </label>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('sesi.index') }}" class="px-4 py-2 border border-gray-300 rounded-md mr-2">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Simpan</button>
        </div>
    </form>
</div>
@endsection
