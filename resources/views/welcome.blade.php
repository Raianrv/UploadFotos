@extends('layouts.main')

@section('title')

@section('content')
    <div class="container">
        <h2>Bem-vindo ao UploadFotos</h2> 
        <h4>Publicações Pendentes</h4> 

         @if (session('sucesso'))
            <div class="alert alert-success">
                {{ session('sucesso') }}
            </div>
        @endif

        @if (session('erro'))
            <div class="alert alert-danger">
                {{ session('erro') }}
            </div>
        @endif
        
        @if ($publicacoes->isEmpty())
            <p>Nenhuma publicação pendente no momento.</p>
        @else
            <div class="row">
                @foreach ($publicacoes as $publicacao)
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ $publicacao->foto_url }}" alt="{{ $publicacao->titulo }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $publicacao->titulo }}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><p><ion-icon name="location-outline"></ion-icon><strong>Local:</strong> {{ $publicacao->local }}</p></li>
                                <li class="list-group-item"><p><ion-icon name="calendar-outline"></ion-icon><strong>Data:</strong> {{ $publicacao->data }}</p></li>
                                <li class="list-group-item"><p><ion-icon name="star-outline"></ion-icon><strong>Status:</strong> {{ ucfirst($publicacao->status) }}</p></li>
                            </ul>
                            @auth
                                @if ($publicacao->status === 'pendente')
                                <div class="card-body">
                                    <form action="{{ route('publicacao.approve', $publicacao->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success">Aprovar</button>
                                    </form>
                                    <form action="{{ route('publicacao.reject', $publicacao->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-danger">Rejeitar</button>
                                    </form>
                                    @else
                                        <p><strong>Ação não permitida</strong> - A publicação já foi {{ $publicacao->status }}.</p>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div> 
        @endif
    </div>
@endsection