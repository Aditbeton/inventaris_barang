<x-main-layout :titlePage="__('Tambah kategori')">
    <div class="row">
        <form action="{{ route('kategori.store') }}" method="POST" class="card col-lg-6">
            <div class="card-body">
                @include('kategori.partials._form')
            </div>
        </form>
    </div>
</x-main-layout>
