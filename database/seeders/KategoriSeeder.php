<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'nama_kategori' => 'PC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Elektronik',
                'created at' => now(),
                'updated at' => now()
            ],
            [
                'nama_kategori' => 'Mebel & Furnitur',
                'created at' => now(),
                'updated at' => now()
            ],
        ]);
    }
}
