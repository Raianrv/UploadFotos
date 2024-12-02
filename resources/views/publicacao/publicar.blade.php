@extends('layouts.main')

@section('title', 'Publicar Foto')

@section('content')
    <div class="container mt-5">
        <h2>Publicar Nova Foto</h2>

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
            <div class="form-group mb-3">
                <label for="titulo"><ion-icon name="star-outline"></ion-icon>Título da Foto</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="local"><ion-icon name="location-outline"></ion-icon>Local (opcional)</label>
                <input type="text" name="local" id="local" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="data"><ion-icon name="calendar-outline"></ion-icon>Data (opcional)</label>
                <input type="date" name="data" id="data" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="arquivo"><ion-icon name="duplicate-outline"></ion-icon>Upload da Foto</label>
                <input type="file" name="arquivo" id="arquivo" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Publicar Foto</button>
        </form>
    </div>
@endsection
