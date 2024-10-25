<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
</head>

<body>
    <header>
        <h1>Mi Aplicación</h1>
        @guest
        <a href="{{ route('login') }}">Iniciar sesión</a>
        @endguest

        @auth
        <p>Hola, {{ Auth::user()->name }}.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
        @endauth
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>