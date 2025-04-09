<?php

namespace Database\Seeders;

use App\Models\Mentor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MentorSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Mentor::create([
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Password@123'),
        ]);

        Mentor::create([
            'nama' => 'Fatih Muzakki',
            'email' => 'fatihmuzakki@gmail.com',
            'password' => Hash::make('Password@123'),
        ]);
    }
}
