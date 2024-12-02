<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UploadFotos')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <div class="flex-container">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">UploadFotos</a> 
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Home<span class="sr-only"></span></a>
                            </li>
                            @auth
                            @if (Route::CurrentRouteName() !== ('dashboard'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('dashboard')}}">Minhas Publicações</a>
                            </li>
                            @endif
                            <li class="nav-item">
                            @if (Route::CurrentRouteName() !== ('publicar.create'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('publicar.create')}}">Publicar Foto</a>
                            </li>
                            @endif
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link" id="btn-sair">Sair</button>
                            </form>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="btn btn-link" id="btn-logar"href="{{ route('login') }}">Logar</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-link" id="btn-registrar"href="{{ route('register') }}">Registrar</a>
                            </li> 
                            @endauth
                        </ul>
                    </div>
                </div>  
            </nav>
        </header>

        <main class="container my-5">
            @yield('content')
        </main>

        <footer class="bg-dark text-white text-center py-4 mt-auto">
                <p>&copy; 2024 UploadFotos. Todos os direitos reservados.</p>
        </footer>
    </div>
</body>
</html>
