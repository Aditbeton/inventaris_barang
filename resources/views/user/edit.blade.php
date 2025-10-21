<x-main-layout :title-page="__('Edit User')">
    <div class="row">
        <form action="{{ route('user.update', $user->id) }}" method="POST" class="card col-lg-6">
            <div class="card-body">
                @method('PUT')
                @include('user.partials._form', ['update' => true])
            </div>
        </form>
    </div>
</x-main-layout>
