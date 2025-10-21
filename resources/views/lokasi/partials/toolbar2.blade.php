<div class="row">
    <div class="col">
        @can('manage lokasi')
        <x-tombol-tambah label="Tambah Barang" href="{{ route('barang.create') }}"/>
        <x-tombol-cetak label="Cetak Laporan Perlokasi" href="#" />
        @endcan
    </div>

    <div class="col">
        <x-form-search placeholder="Cari Lokasi"/>
    </div>
</div>
