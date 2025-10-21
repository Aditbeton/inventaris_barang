<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            KategoriSeeder::class,
            LokasiSeeder::class,
            BarangSeeder::class,
        ]);

        $petugas = User::factory()->create([
            'name' => 'gut',
            'email' => 'petugas@mail.com',
        ]);
         $admin = User::factory()->create([
            'name' => 'Lapet',
            'email' => 'admin@mail.com',
        ]);

        $admin->assignRole('admin');
        $petugas->assignRole('petugas');
    }
}
