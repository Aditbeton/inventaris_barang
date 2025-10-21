<x-main-layout :title-page="__('Barang di ' . $nama_lokasi)">
    <div class="card">
        <div class="card-body">
            @include('lokasi.partials.toolbar2')
            <x-notif-alert class="mt-4" />
        </div>

        {{-- tampilkan daftar barang di lokasi ini --}}
        @include('barang.partials.list-barang')

        <div class="card-body">
            {{ $barangs->links() }}
        </div>
    </div>
</x-main-layout>
