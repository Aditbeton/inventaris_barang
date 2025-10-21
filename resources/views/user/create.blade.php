<x-main-layout :title-page="__('Tambah User')">
    <div class="row">
        <form action="{{ route('user.store') }}" method="POST" class="card col-lg-6">
            <div class="card-body">
                @include('user.partials._form')
            </div>
        </form>
    </div>
</x-main-layout>
