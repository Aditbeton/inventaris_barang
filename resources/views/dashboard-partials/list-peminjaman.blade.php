<div class="card-body">
    @php
        $kondisis = [
            [
                'judul' => 'Dikembalikan',
                'jumlah' => $jumlahPeminjaman,
                'kondisi' => $statusDikembalikan,
                'color' => 'success',
            ],
            [
                'judul' => 'Dipinjam',
                'jumlah' => $jumlahPeminjaman,
                'kondisi' => $statusDipinjam,
                'color' => 'warning',
            ],
            [
                'judul' => 'Terlambat',
                'jumlah' => $jumlahPeminjaman,
                'kondisi' => $statusTerlambat,
                'color' => 'danger',
            ],
        ];
    @endphp

    @foreach ($kondisis as $kondisi)
        @php
            extract($kondisi);
        @endphp

        <x-progress-kondisi :judul="$judul" :jumlah="$jumlah" :kondisi="$kondisi" :color="$color" />
    @endforeach
</div>
