@extends('layouts.main')

@section('title', 'Bem-vindo ao UploadFotos')

@section('content')
    <h1>Bem-vindo ao UploadFotos</h2>
    <h2>Publicações Pendentes</h2>
    @if ($publicacoes->isEmpty())
        <p>Nenhuma publicação pendente no momento.</p>
    @else
        @foreach ($publicacoes as $publicacao)
            <div class="publicacao">
                <h3>{{ $publicacao->titulo }}</h4>
                <img src="{{ Storage::url($publicacao->foto_url) }}" alt="{{ $publicacao->titulo }}">
                <p>{{ $publicacao->local }}</p>
                <p>{{ $publicacao->data }}</p>
                <p>Status: {{ $publicacao->status }}</p>

                @auth
                    <form action="{{ route('aprovar', $publicacao->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Aprovar</button>
                    </form>
                    <form action="{{ route('rejeitar', $publicacao->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Rejeitar</button>
                    </form>
                @endauth
            </div>
        @endforeach
    @endif
@endsection
