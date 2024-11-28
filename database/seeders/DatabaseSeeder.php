<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Karyawan::create([
            'nik' => '2024100001',
            'nama_lengkap' => 'Roni Zeki',
            'password' => Hash::make('123456'),
            'jabatan' => 'Fullstack Developer',
            'nohp' => '085272339039',
            'email' => 'ronizeki83@gmail.com',
            'remember_token' => Str::random(10)
        ]);
    }
}
