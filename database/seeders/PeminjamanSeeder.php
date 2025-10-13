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
        // pastiin ada minimal 1 barang di tabel barang
        $barang = Barang::first();
        if (!$barang) {
            $barang = Barang::create([
                'nama_barang' => 'Laptop ASUS',
                'stok' => 10,
                'kategori_id' => 1, // sesuaikan sama id kategori yg ada
                'lokasi_id' => 1,   // sesuaikan sama id lokasi yg ada
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
