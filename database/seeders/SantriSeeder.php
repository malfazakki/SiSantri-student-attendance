<?php

namespace Database\Seeders;

use App\Models\Santri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SantriSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Create 10 santri for each angkatan and jurusan combination
        for ($angkatan = 1; $angkatan <= 3; $angkatan++) {
            for ($jurusan = 1; $jurusan <= 3; $jurusan++) {
                for ($i = 1; $i <= 10; $i++) {
                    $nis = "20" . (20 + $angkatan) . str_pad($jurusan, 2, '0', STR_PAD_LEFT) . str_pad($i, 3, '0', STR_PAD_LEFT);

                    Santri::create([
                        'nama' => "Santri $1 Angkatan {$angkatan} Jurusan {$jurusan}",
                        'nis' => $nis,
                        'angkatan_id' => $angkatan,
                        'jurusan_id' => $jurusan,
                    ]);
                }
            }
        }
    }
}
