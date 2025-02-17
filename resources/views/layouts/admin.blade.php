<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar is-fixed-top">
        <div class="navbar-brand">
            <a class="navbar-item mobile-aside-button">
                <span class="icon"><i class="bi bi-list"></i></span>
            </a>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="aside is-placed-left is-expanded">
        <div class="aside-tools">
            <h1 class="text-6xl font-bold text-center text-white">
                Admin
            </h1>
            <p class="text-4xl mt-4"><i class="bi bi-substack"></i></p>
            <b class="font-black">BlogEC</b>
        </div>
        <div class="menu is-menu-main">
            <p class="menu-label">General</p>
            <ul class="menu-list">
                <li class="active">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="icon"><i class="bi bi-aspect-ratio-fill"></i></span>
                        <span class="menu-item-label">Dashboard</span>
                    </a>
                </li>
            </ul>
            <p class="menu-label">Administrar</p>
            <ul class="menu-list">
                <li class="">
                    <a href="{{ route('admin.categories.index') }}">
                        <span class="icon"><i class="bi bi-list-ul"></i></span>
                        <span class="menu-item-label">Categorias</span>
                    </a>
                </li>
            </ul>
            <ul class="menu-list">
                <li class="">
                    <a href="{{ route('admin.users.index') }}">
                        <span class="icon"><i class="bi bi-people-fill"></i></span>
                        <span class="menu-item-label">Usuarios</span>
                    </a>
                </li>
            </ul>

            <p class="menu-label">Salir</p>

            {{-- LogOut --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <ul class="menu-list">
                    <li class="">
                        <button type="submit" class="w-full">
                            <span class="icon"><i class="bi bi-door-open-fill"></i></span>
                            <span class="menu-item-label text-start">Logout</span>
                        </button>
                    </li>
                </ul>
            </form>
        </div>
    </aside>

    <!-- Contenedor Principal -->
    <div class="ml-0 lg:ml-60 transition-all mt-14">
        <div class="w-10/12 mx-auto z-50">
            @include('alerts.alerts-admin')
        </div>
        {{ $slot }}
    </div>

    <!-- Script para el sidebar -->
    <script>
        document.querySelectorAll('.mobile-aside-button').forEach(el => {
            el.addEventListener('click', () => {
                document.documentElement.classList.toggle('aside-mobile-expanded');
            });
        });
    </script>
</body>


</html>
