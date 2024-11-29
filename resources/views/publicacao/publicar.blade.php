@extends('layouts.main')

@section('title', 'Publicar Foto')

@section('content')
    <h1>Publicar Nova Foto</h1>

    @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('publicar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="titulo">Título da Foto *</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="local">Local (opcional)</label>
            <input type="text" name="local" id="local" class="form-control">
        </div>

        <div class="form-group">
            <label for="data">Data (opcional)</label>
            <input type="date" name="data" id="data" class="form-control">
        </div>

        <div class="form-group">
            <label for="arquivo">Upload da Foto *</label>
            <input type="file" name="arquivo" id="arquivo" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Publicar Foto</button>
    </form>
@endsection
