<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Jurusan::create([
            'nama' => 'Programmer',
        ]);

        Jurusan::create([
            'nama' => 'Multimedia',
        ]);

        Jurusan::create([
            'nama' => 'Marketing',
        ]);
    }
}
