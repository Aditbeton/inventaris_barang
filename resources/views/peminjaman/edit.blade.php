<x-main-layout :title-page="__('Edit Peminjaman')">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('peminjaman.partials.form', ['peminjaman' => $peminjaman, 'tombol' => 'UPDATE'])
            </form>
        </div>
    </div>
</x-main-layout>
