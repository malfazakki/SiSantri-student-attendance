@extends('layouts.app')

@section('title', 'Sesi Absen - SiSantri')

@section('header', 'Manajemen Sesi Absen')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <div>
            <h3 class="text-lg font-semibold">Daftar Sesi Absen</h3>
            <p class="text-sm text-gray-500">Kelola sesi absensi santri</p>
        </div>
        <a href="{{ route('sesi.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">
            Tambah Sesi
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
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Sesi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($sesiAbsens as $sesi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $sesi->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($sesi->waktu)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 {{ $sesi->aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-xs">
                                    {{ $sesi->aktif ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap max-w-[108px]">
                                <div class="flex space-x-2 w-fit">
                                    <a href="{{ route('sesi.edit', $sesi) }}"
                                        class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-md">Edit</a>

                                    <form action="{{ route('sesi.toggle-active', $sesi) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="px-2 py-1 {{ $sesi->aktif ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} rounded-md">
                                            {{ $sesi->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('sesi.destroy', $sesi) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus sesi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 bg-red-100 text-red-800 rounded-md">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data sesi absen</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
