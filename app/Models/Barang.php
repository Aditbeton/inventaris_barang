<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'lokasi_id',
        'jumlah',
        'satuan',
        'kondisi',
        'sumber_dana',
        'tanggal_pengadaan',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // 🔢 Jumlah barang yang sedang dipinjam
    public function getJumlahDipinjamAttribute()
    {
        return $this->peminjamans()
            ->whereIn('status', ['Dipinjam', 'Terlambat'])
            ->sum('jumlah');
    }

    // 📦 Jumlah barang yang masih tersedia
    public function getJumlahTersediaAttribute()
    {
        return $this->jumlah - $this->jumlah_dipinjam;
    }
}
