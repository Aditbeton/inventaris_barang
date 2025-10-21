<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-danger" href="/">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    @auth <li class="nav-item"> <a class="btn btn-outline-danger ms-2" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item"> <a href="{{ route('login') }}" class="btn btn-outline-danger ms-2">Masuk</a>
                    </li> @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
