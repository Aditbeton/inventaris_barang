<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lokasis')->insert([
            [
                'nama_lokasi' => 'Lab PPLG 3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_lokasi' => 'Lab PPLG 2',
                'created at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_lokasi' => 'Lab PPLG 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
