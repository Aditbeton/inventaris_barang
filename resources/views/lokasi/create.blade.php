<x-main-layout :titlePage="__('Tambah Lokasi')">
    <div class="row">
        <form action="{{ route('lokasi.store') }}" method="POST" class="card col-lg-6">
            <div class="card-body">
                @include('lokasi.partials._form')
            </div>
        </form>
    </div>
</x-main-layout>
