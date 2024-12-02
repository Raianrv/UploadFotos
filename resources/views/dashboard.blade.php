@extends('layouts.main')

@section('title', 'Minhas Publicações')

@section('content')
    <div class="container">
        <h2>Minhas Publicações</h2> 

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
            <p>Você ainda não publicou nenhuma foto.</p>
        @else
            <div class="row">
                @foreach ($publicacoes as $publicacao)
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ $publicacao->foto_url }}" class="card-img-top" alt="{{ $publicacao->titulo }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $publicacao->titulo }}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><p><ion-icon name="location-outline"></ion-icon><strong>Local:</strong> {{ $publicacao->local }}</p></li>
                                <li class="list-group-item"><p><ion-icon name="calendar-outline"></ion-icon><strong>Data:</strong> {{ $publicacao->data }}</p></li>
                                <li class="list-group-item"><ion-icon name="star-outline"></ion-icon><p><strong>Status:</strong> {{ ucfirst($publicacao->status) }}</p></li>
                            </ul>
                            <div class="card-body">
                                <form action={{ route('publicacao.destroy', $publicacao->id) }} method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"class="btn btn-danger">Deletar</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection