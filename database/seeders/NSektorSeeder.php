<?php

namespace Database\Seeders;

use App\Models\NSektor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NSektorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NSektor::create([
            'nama_sektor' => 'Sektor Kesehatan',
            'deskripsi' => 'Sektor Kesehatan',
        ]); 
        NSektor::create([
            'nama_sektor' => 'Sektor Pertahanan',
            'deskripsi' => 'Sektor Pertahanan',
        ]); 
        NSektor::create([
            'nama_sektor' => 'Sektor Pendidikan',
            'deskripsi' => 'Sektor Pendidikan',
        ]); 
        NSektor::create([
            'nama_sektor' => 'Sektor Perdagangan',
            'deskripsi' => 'Sektor Perdagangan',
        ]); 
        NSektor::create([
            'nama_sektor' => 'Sektor Ketenagakerjaan',
            'deskripsi' => 'Sektor Ketenagakerjaan',
        ]); 
        NSektor::create([
            'nama_sektor' => 'Sektor Perindustrian',
            'deskripsi' => 'Sektor Perindustrian',
        ]); 
        NSektor::create([
            'nama_sektor' => 'Sektor Komunikasi',
            'deskripsi' => 'Sektor Komunikasi',
        ]); 
        NSektor::create([
            'nama_sektor' => 'Sektor Pertanian',
            'deskripsi' => 'Sektor Pertanian',
        ]); 
        NSektor::create([
            'nama_sektor' => 'Sektor Perhubungan',
            'deskripsi' => 'Sektor Perhubungan',
        ]); 
        NSektor::create([
            'nama_sektor' => 'Sektor Periwisata',
            'deskripsi' => 'Sektor Periwisata',
        ]); 
    }
}
