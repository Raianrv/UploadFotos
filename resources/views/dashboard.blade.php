@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <h1>Minhas Publicações</h1>

    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    @if ($publicacoes->isEmpty())
        <p>Você ainda não publicou nenhuma foto.</p>
    @else
        @foreach ($publicacoes as $publicacao)
            <div class="publicacao">
                <h4>{{ $publicacao->titulo }}</h4>
                <img src="{{ asset('uploads/' . $publicacao->foto_url) }}" alt="{{ $publicacao->titulo }}">
                <p>{{ $publicacao->local }}</p>
                <p>{{ $publicacao->data }}</p>
                <p>Status: {{ $publicacao->status }}</p>
            </div>
        @endforeach
    @endif
@endsection
