<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UploadFotos')</title>

    {{-- Link para o arquivo CSS do Header e Footer --}}
    <link rel="stylesheet" href="{{ asset('css/header-footer.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            UploadFotos
        </div>
        <nav>
            @auth
                <a href="{{ route('dashboard') }}">Minhas Publicações</a>

                {{-- Formulário para Logout --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0; font: inherit;">
                        Sair
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">Logar</a>
                <a href="{{ route('register') }}">Registrar</a>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} UploadFotos. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
