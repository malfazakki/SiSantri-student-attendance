<?php

namespace App\Http\Controllers;

use App\Models\SesiAbsen;
use Illuminate\Http\Request;

class SesiAbsenController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $sesiAbsens = SesiAbsen::all();

        return view('sesi.index', compact('sesiAbsens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('sesi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'waktu' => 'required',
            'aktif' => 'boolean'
        ]);

        SesiAbsen::create($validated);

        return redirect()->route('sesi.index')->with('success', 'Sesi absen berhasil ditambahkan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SesiAbsen $sesi) {
        return view('sesi.edit', compact('sesi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SesiAbsen $sesi) {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'waktu' => 'required',
            'aktif' => 'boolean',
        ]);

        // Set aktif to false if not provided
        if (!isset($validated['aktif'])) {
            $validated['aktif'] = false;
        }

        $sesi->update($validated);

        return redirect()->route('sesi.index')->with('success', "Sesi absen berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SesiAbsen $sesi) {
        // Check if the sesi is used in any absensi
        if ($sesi->absensis()->count() > 0) {
            return redirect()->route('sesi.index')->with('error', 'Sesi absen tidak dapat dihapus karena sudah digunakan dalam absensi.');
        }

        $sesi->delete();

        return redirect()->route('sesi.index')->with('success', 'Sesi absen berhasil dihapus.');
    }

    /**
     * Toggle the active status of the specified resource.
     */
    public function toggleActive(SesiAbsen $sesi) {
        $sesi->aktif = !$sesi->aktif;
        $sesi->save();

        return redirect()->route('sesi.index')->with('success', 'Status sesi absen berhasil diubah.');
    }
}
