<x-main-layout :titlePage="__('Edit Lokasi')">
    <div class="row">
        <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST" class="card col-lg-6">
            <div class="card-body">
                @method('PUT')
                @include('lokasi.partials._form', ['update' => true])
            </div>
        </form>
    </div>
</x-main-layout>
