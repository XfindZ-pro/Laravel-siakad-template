<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodis = ['Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Teknik Mesin', 'Teknik Sipil'];
        $angkatans = [2020, 2021, 2022, 2023, 2024];
        $genders = ['Laki-laki', 'Perempuan'];

        // Clear existing data to avoid confusion
        \App\Models\Student::truncate();

        for ($i = 1; $i <= 50; $i++) {
            $angkatan = $angkatans[array_rand($angkatans)];
            // Students from 2020 and 2021 have higher chance of being graduated
            $isGraduated = ($angkatan <= 2021) ? (rand(0, 10) > 3) : (rand(0, 10) > 8);

            \App\Models\Student::create([
                'name' => 'Student ' . $i,
                'email' => 'student' . $i . '@example.com',
                'prodi' => $prodis[array_rand($prodis)],
                'angkatan' => $angkatan,
                'is_graduated' => $isGraduated,
                'gender' => $genders[array_rand($genders)],
            ]);
        }
    }
}
