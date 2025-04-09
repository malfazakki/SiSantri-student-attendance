<?php

namespace Database\Seeders;

use App\Models\SesiAbsen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SesiAbsenSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        SesiAbsen::create([
            'nama' => 'Shubuh',
            'waktu' => '04:30:00',
            'aktif' => true,
        ]);

        SesiAbsen::create([
            'nama' => 'Dzuhur',
            'waktu' => '12:30:00',
            'aktif' => true,
        ]);

        SesiAbsen::create([
            'nama' => 'Ashar',
            'waktu' => '15:30:00',
            'aktif' => true,
        ]);

        SesiAbsen::create([
            'nama' => 'Maghrib',
            'waktu' => '18:00:00',
            'aktif' => true,
        ]);
    }
}
