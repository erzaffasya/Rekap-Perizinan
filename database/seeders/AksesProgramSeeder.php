<?php

namespace Database\Seeders;

use App\Models\Akses_program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AksesProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Akses_program::create([
            'id' => 1,
            'user_id' => 1,
            'program_id' => 1,
        ]);
        Akses_program::create([
            'id' => 2,
            'user_id' => 2,
            'program_id' => 1,
        ]);
        Akses_program::create([
            'id' => 3,
            'user_id' => 1,
            'program_id' => 2,
        ]);
    }
}
