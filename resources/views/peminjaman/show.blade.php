<!-- detail peminjaman -->
<x-main-layout :titlePage="__('Detail Peminjaman')">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Tanggal Pinjam</th>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kembali (rencana)</th>
                    <td
                        class="{{ $peminjaman->status == 'Dikembalikan' ? 'text-success' : ($peminjaman->status == 'Terlambat' ? 'text-danger' : '') }}">
                        {{ $peminjaman->tanggal_kembali }} 
                    </td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $peminjaman->nama_peminjam }}</td>
                </tr>
                <tr>
                    <th>Barang</th>
                    <td>{{ $peminjaman->barang->nama_barang }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ $peminjaman->jumlah }}</td>
                </tr>
                <tr>
                    <th>Kondisi</th>
                    <td>
                        @php
                            $badgeClass = 'bg-success';
                            if ($peminjaman->barang->kondisi == 'Rusak Ringan') {
                                $badgeClass = 'bg-warning text-dark';
                            }
                            if ($peminjaman->barang->kondisi == 'Rusak Berat') {
                                $badgeClass = 'bg-danger';
                            }
                        @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ $peminjaman->barang->kondisi }}
                            </span>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($peminjaman->status == 'Dipinjam')
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @elseif($peminjaman->status == 'Dikembalikan')
                            <span class="badge bg-success">Dikembalikan</span>
                        @else
                            <span class="badge bg-danger">Terlambat</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Dikembalikan</th>
                    <td>{{ $peminjaman->tanggal_dikembalikan }}</td>
                </tr>
            </table>

            <div class="mt-5">
                <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning">
                    Edit
                </a>
                <x-kembali-ke-back :href="route('peminjaman.index')" />
            </div>
        </div>
    </div>
</x-main-layout>
