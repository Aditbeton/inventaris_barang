<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peminjaman;
use App\Models\Barang;
use Carbon\Carbon;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = Barang::first();
        if (!$barang) {
            $barang = Barang::create([
                'nama_barang' => 'Laptop ASUS',
                'stok' => 10,
                'kategori_id' => 1,
                'lokasi_id' => 1,
            ]);
        }

        Peminjaman::create([
            'tanggal_pinjam' => Carbon::now(),
            'tanggal_kembali' => Carbon::now()->addDays(3),
            'nama_peminjam' => 'rusdi',
            'barang_id' => $barang->id,
            'jumlah' => 1,
            'status' => 'Dipinjam',
            'tanggal_dikembalikan' => null,
        ]);
    }
}
