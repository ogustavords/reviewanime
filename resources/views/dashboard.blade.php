<x-app-layout>
    <link rel="stylesheet" href="{{ asset('estilo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Animes Recomendados') }}
        </h2>
    </x-slot>

    <div class="container">
        @if(Auth::check() && Auth::user()->is_admin)
            <a href="{{ route('anime.create') }}" class="button mb-4">Criar Anime</a> 
        @endif

        <!-- Barra de Pesquisa -->
        <form action="{{ route('dashboard') }}" method="GET" class="mb-4">
            <input type="text" name="search" value="{{ old('search', $search ?? '') }}" class="form-control" placeholder="Pesquisar por nome de anime...">
            <button type="submit" class="btn btn-primary mt-2">Pesquisar</button>
        </form>

        <div class="anime-cards">
            @foreach ($animes as $anime)
            <div class="card" style="cursor: pointer;">
                <!-- Exibe a imagem do anime -->
                @if($anime->img_itens)
                    <div class="card-image">
                        <img src="{{ asset('storage/img_itens/' . $anime->img_itens) }}" alt="{{ $anime->title }}" class="img-fluid" style="height: 380px; object-fit: cover;">
                    </div>
                @endif

                <div class="card-title">{{ $anime->title }}</div>
                <div class="card-description">{{ $anime->description }}</div>

                <!-- Transformando a div em um link para redirecionar aos detalhes -->
                <a href="{{ route('anime.details', ['id' => $anime->id]) }}" class="stretched-link"></a>
                
                @if(Auth::check() && Auth::user()->is_admin)
                    <form action="{{ route('anime.destroy', ['id' => $anime->id]) }}" method="POST" class="delete-form mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button delete-button">Apagar Anime</button>
                    </form>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
