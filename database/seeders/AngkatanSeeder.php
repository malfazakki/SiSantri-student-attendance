<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AngkatanSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Angkatan::create([
            'nama' => 'Angkatan 1',
            'tahun' => 2024,
        ]);

        Angkatan::create([
            'nama' => 'Angkatan 2',
            'tahun' => 2025,
        ]);

        Angkatan::create([
            'nama' => 'Angkatan 3',
            'tahun' => 2026,
        ]);
    }
}
