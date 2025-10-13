<!-- tambah data -->
<x-main-layout :title-page="__('Tambah Peminjaman')">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                @include('peminjaman.partials.form', ['peminjaman' => null, 'tombol' => 'SIMPAN'])
            </form>
        </div>
    </div>
</x-main-layout>