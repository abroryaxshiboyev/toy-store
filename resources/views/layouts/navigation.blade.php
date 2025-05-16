<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">O'yinchoqlar Do'koni</a>
        <div class="navbar-nav">
            @auth
                <a class="nav-link text-white" href="{{ route('admin.toys.index') }}">O'yinchoqlar</a>
                <a class="nav-link text-white" href="{{ route('admin.orders.index') }}">Buyurtmalar</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-white">Chiqish</button>
                </form>
            @else
                <a class="nav-link text-white" href="{{ route('login') }}">Kirish</a>
                <a class="nav-link text-white" href="{{ route('register') }}">Ro'yxatdan o'tish</a>
            @endauth
        </div>
    </div>
</nav>