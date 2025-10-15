<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBarang = Barang::count();
        $jumlahKategori = Kategori::count();
        $jumlahLokasi = Lokasi::count();
        $jumlahUser = User::count();

        $jumlahPeminjaman = Peminjaman::count();
        $statusDipinjam = Peminjaman::where('status', 'Dipinjam')->count();
        $statusDikembalikan = Peminjaman::where('status', 'Dikembalikan')->count();
        $statusTerlambat = Peminjaman::where('status', 'Terlambat')->count();

        $kondisiBaik = Barang::where('kondisi', 'Baik')->count();
        $kondisiRusakRingan = Barang::where('kondisi', 'Rusak Ringan')->count();
        $kondisiRusakBerat = Barang::where('kondisi', 'Rusak Berat')->count();

        $barangTerbaru = Barang::with(['kategori', 'lokasi'])
            ->latest()
            ->take(5)
            ->get();

        $peminjamanTerbaru = Peminjaman::with(['barang'])
            ->latest()
            ->take(5)
            ->get();


        return view('dashboard', compact(
            'jumlahBarang',
            'jumlahKategori',
            'jumlahLokasi',
            'jumlahUser',
            'jumlahPeminjaman',
            'statusDipinjam',
            'statusDikembalikan',
            'statusTerlambat',
            'kondisiBaik',
            'kondisiRusakRingan',
            'kondisiRusakBerat',
            'barangTerbaru',
            'peminjamanTerbaru',
        ));

    }
}
