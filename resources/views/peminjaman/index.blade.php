<x-main-layout :title-page="__('Peminjaman')">
    <div class="card">
        <div class="card-body">
            {{-- Toolbar (tambah data, cari, cetak) --}}
            @include('peminjaman.partials.toolbar')
            <x-notif-alert class="mt-4" />
        </div>

        {{-- Tabel daftar peminjaman --}}
        @include('peminjaman.partials.list-peminjaman')

        <div class="card-body">
            {{ $peminjamans->links() }}
        </div>
    </div>
</x-main-layout>