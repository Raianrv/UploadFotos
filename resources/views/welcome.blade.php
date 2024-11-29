@extends('layouts.main')

@section('title')

@section('content')
    <h1>Bem-vindo ao UploadFotos</h1>

    <h2>Publicações Pendentes</h2>
    
    @if ($publicacoes->isEmpty())
        <p>Nenhuma publicação pendente no momento.</p>
    @else
        @foreach ($publicacoes as $publicacao)
            <div class="publicacao">
                <h3>{{ $publicacao->titulo }}</h3>
                <img src="{{ asset('uploads/' . $publicacao->foto_url) }}" alt="{{ $publicacao->titulo }}">
                <p><strong>Local:</strong> {{ $publicacao->local }}</p>
                <p><strong>Data:</strong> {{ $publicacao->data }}</p>
                <p><strong>Status:</strong> {{ ucfirst($publicacao->status) }}</p>

                @auth
                    @if ($publicacao->status === 'pendente')
                        <div class="actions">
                            <!-- Aprovar Publicação -->
                            <form action="{{ route('publicacao.approve', $publicacao->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Aprovar</button>
                            </form>

                            <!-- Rejeitar Publicação -->
                            <form action="{{ route('publicacao.reject', $publicacao->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Rejeitar</button>
                            </form>
                        </div>
                    @else
                        <p><strong>Ação não permitida</strong> - A publicação já foi {{ $publicacao->status }}.</p>
                    @endif
                @endauth
            </div>
        @endforeach
    @endif
@endsection