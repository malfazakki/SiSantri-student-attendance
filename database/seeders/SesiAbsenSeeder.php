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
            'nama' => 'Produktif 1',
            'waktu' => '07:00:00',
            'aktif' => true,
        ]);

        SesiAbsen::create([
            'nama' => 'Produktif 2',
            'waktu' => '13:00:00',
            'aktif' => true,
        ]);

        SesiAbsen::create([
            'nama' => 'Produktif 3',
            'waktu' => '16:00:00',
            'aktif' => true,
        ]);

        SesiAbsen::create([
            'nama' => 'Produktif 4',
            'waktu' => '20:00:00',
            'aktif' => true,
        ]);
    }
}
