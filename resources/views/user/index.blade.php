<x-main-layout :title-page="__('Users')">
    <div class="card">
        <div class="card-body">
            @include('user.partials.ireng')

            <x-notif-alert class="mt-4"/>
        </div>

        @include('user.partials.list-user')

        <div class="card-body">
            {{ $users->links() }}
        </div>
    </div>
</x-main-layout>
