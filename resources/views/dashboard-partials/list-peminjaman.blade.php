<div class="card-body">
    @php
        $kondisis = [
            [
                'judul' => 'Dikembalikan',
                'jumlah' => $jumlahBarang,
                'kondisi' => $kondisiBaik,
                'color' => 'success',
            ],
            [
                'judul' => 'Dipinjam',
                'jumlah' => $jumlahBarang,
                'kondisi' => $kondisiRusakRingan,
                'color' => 'warning',
            ],
            [
                'judul' => 'Terlambat',
                'jumlah' => $jumlahBarang,
                'kondisi' => $kondisiRusakBerat,
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
