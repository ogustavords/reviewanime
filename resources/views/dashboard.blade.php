<x-app-layout>
<link rel="stylesheet" href="{{asset('estilo.css')}}">
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

        <div class="anime-cards">
            @foreach ($animes as $anime)
            <div class="card"  >
                <div class="card-title">{{ $anime->title }}</div>
                <div class="card-description">{{ $anime->description }}</div>
                <a href="{{ route('anime.details', ['id' => $anime->id]) }}" class="button">Ver detalhes</a>
                
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
