<x-main-layout :titlePage="__('Edit Kategori')">
    <div class="row">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="card col-lg-6">
            <div class="card-body">
                @method('PUT')
                @include('kategori.partials._form', ['update' => true])
            </div>
        </form>
    </div>
</x-main-layout>
