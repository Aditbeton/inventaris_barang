<x-tabel-list>
    <x-slot name="header">
        <tr>
            <th>No.</th>
            <th>Nama Peminjam</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
    </x-slot>

    @forelse ($peminjamans as $index => $peminjaman)
        <tr>
            <td>{{ $peminjamans->firstItem() + $index }}</td>
            <td>{{ $peminjaman->nama_peminjam }}</td>
            <td>{{ $peminjaman->barang->nama_barang ?? '-' }}</td>
            <td>{{ $peminjaman->jumlah }}</td>
            <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') }}</td>
            <td>
                @php
                    $badgeClass = 'bg-warning text-dark'; // default dipinjam
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
            <td class="text-end">
                @can('manage peminjaman')
                    <x-tombol-aksi href="{{ route('peminjaman.show', $peminjaman->id) }}" type="show" />
                    <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-outline-success" title="Tandai Dikembalikan">
                            <i class="bi bi-check2-circle"></i>
                        </button>
                    </form>
                @endcan
                @can('delete peminjaman')
                    <x-tombol-aksi href="{{ route('peminjaman.destroy', $peminjaman->id) }}" type="delete" />
                @endcan
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center">
                <div class="alert alert-danger">
                    Data peminjaman belum tersedia.
                </div>
            </td>
        </tr>
    @endforelse
</x-tabel-list>
