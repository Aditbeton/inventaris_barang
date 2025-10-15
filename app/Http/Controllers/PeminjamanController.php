<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Peminjaman::where('status', 'Dipinjam')
            ->where('tanggal_kembali', '<', Carbon::now())
            ->update(['status' => 'Terlambat']);

        $peminjamans = Peminjaman::with('barang')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama_peminjam', 'like', '%' . $request->search . '%')
                    ->orWhereHas('barang', function ($q) use ($request) {
                        $q->where('nama_barang', 'like', '%' . $request->search . '%');
                    });
            })
            ->orderBy('tanggal_pinjam', 'desc')
            ->paginate(5);


        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
        return view('peminjaman.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pinjam' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_kembali' => 'required|date_format:Y-m-d\TH:i|after_or_equal:tanggal_pinjam',
            'nama_peminjam' => 'required|string|max:100',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);
        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah > $barang->jumlah_tersedia) {
            return back()
                ->withInput()
                ->with('error', 'Jumlah yang diminta melebihi jumlah tersedia! Sisa tersedia: ' . $barang->jumlah_tersedia . ' ' . $barang->satuan);
        }

        $validated['tanggal_pinjam'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_pinjam)->format('Y-m-d H:i:s');
        $validated['tanggal_kembali'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_kembali)->format('Y-m-d H:i:s');
        $validated['status'] = 'Dipinjam';

        Peminjaman::create($validated);

        $barang->update([
            'jumlah_dipinjam' => $barang->jumlah_dipinjam + $request->jumlah,
            'jumlah_tersedia' => $barang->jumlah_tersedia - $request->jumlah,
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        $barangs = Barang::all();
        return view('peminjaman.show', compact('peminjaman', 'barangs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        $barangs = Barang::all();
        return view('peminjaman.edit', compact('peminjaman', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     * (Diperbolehkan edit tanggal kembali untuk perpanjangan)
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_kembali' => 'required|date_format:Y-m-d\TH:i|after_or_equal:tanggal_pinjam',
            'nama_peminjam' => 'required|string|max:100',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['tanggal_pinjam'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_pinjam)->format('Y-m-d H:i:s');
        $data['tanggal_kembali'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_kembali)->format('Y-m-d H:i:s');

        $peminjaman->update($data);

        if (
            $peminjaman->status === 'Terlambat' &&
            Carbon::parse($peminjaman->tanggal_kembali)->isFuture()
        ) {
            $peminjaman->update(['status' => 'Dipinjam']);
        }

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diupdate');
    }


    /**
     * 🔁 Ubah status jadi "Dikembalikan"
     */
    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'Dikembalikan') {
            return redirect()->route('peminjaman.index')
                ->with('info', 'Barang ini sudah dikembalikan sebelumnya.');
        }

        $peminjaman->update([
            'status' => 'Dikembalikan',
            'tanggal_dikembalikan' => now(),
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Barang berhasil dikembalikan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        // Cegah penghapusan jika barang belum dikembalikan
        if ($peminjaman->status !== 'Dikembalikan') {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Data peminjaman tidak dapat dihapus karena barang belum dikembalikan.');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function laporpin()
    {
        $peminjamans = Peminjaman::with('barang')->orderBy('tanggal_pinjam', 'desc')->get();

        $totalDipinjam = $peminjamans->where('status', 'Dipinjam')->count();
        $totalTerlambat = $peminjamans->where('status', 'Terlambat')->count();
        $totalDikembalikan = $peminjamans->where('status', 'Dikembalikan')->count();

        $data = [
            'title' => 'Laporan Data Peminjaman Barang',
            'date' => date('d F Y'),
            'peminjamans' => $peminjamans,
            'totalDipinjam' => $totalDipinjam,
            'totalTerlambat' => $totalTerlambat,
            'totalDikembalikan' => $totalDikembalikan,
        ];

        $pdf = Pdf::loadView('peminjaman.laporan', $data);

        return $pdf->stream('laporan-peminjaman-barang.pdf');
    }
}
