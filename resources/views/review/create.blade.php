<x-app-layout>
<link rel="stylesheet" href="{{asset('estilo.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Review para o Anime') }} {{ $anime->title }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="review-card">
            <form action="{{ route('review.store', ['id' => $anime->id]) }}" method="POST">
                @csrf
                <div style="text-align: center;">
                    <div class="anime-image" style="background-image: url('{{ $anime->image_url }}');"></div>
                    <label for="comment">Review</label>
                    <textarea id="comment" name="comment" rows="4" class="form-control"></textarea>
                    <label for="rating">Classificação</label>
                    <input type="number" id="rating" name="rating" min="1" max="10" class="form-control" required>
                </div>
                <div class="mt-4" style="text-align: center;">
                    <button type="submit" class="button">Enviar Review</button>
                </div>
            </form>
        </div>
    </div>

    
</x-app-layout>
