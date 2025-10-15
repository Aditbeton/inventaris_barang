<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Nama Peminjam</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Tgl. Pinjam</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($peminjamanTerbaru as $peminjaman)
            <tr>
                <td>{{ $peminjaman->nama_peminjam }}</td>
                <td>{{ $peminjaman->barang->nama_barang ?? '-' }}</td>
                <td>{{ $peminjaman->jumlah }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>
                    @php
                        $badgeClass = 'bg-warning text-dark';
                        if ($peminjaman->status === 'Dikembalikan') {
                            $badgeClass = 'bg-success';
                        }
                        if ($peminjaman->status === 'Terlambat') {
                            $badgeClass = 'bg-danger';
                        }
                    @endphp

                    <span class="badge {{ $badgeClass }}">
                        {{ $peminjaman->status }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada data barang.</td>
            </tr>
        @endforelse
    </tbody>
</table>
