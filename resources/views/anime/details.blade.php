<x-app-layout>
<link rel="stylesheet" href="{{asset('estilo.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Anime') }} {{ $anime->title }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="card-details">
            <div class="card-title">{{ $anime->title }}</div>
            <div class="anime-image" style="background-image: url('{{ $anime->image_url }}');"></div>
            <div class="card-description">Descrição: {{ $anime->description }}</div>
            <a href="{{ route('review.create', ['id' => $anime->id]) }}" class="button">Escrever uma Review</a>
        </div>

        @foreach ($anime->reviews as $review)
            <div class="card">
                <div class="card-title">Review do usuário {{ $review->user->name }}</div>
                <div class="card-description">{{ $review->comment }}</div> 
                <div class="card-rating">Classificação: {{ $review->rating }} / 10</div> 
            </div>
        @endforeach
    </div>  
</x-app-layout>
