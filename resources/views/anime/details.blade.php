<x-app-layout>
    <link rel="stylesheet" href="{{ asset('estilo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Detalhes do Anime') }}: {{ $anime->title }}
        </h2>
    </x-slot>

    <div class="container my-5">
        <!-- Detalhes do Anime -->
        <div class="anime-details text-center mb-5">
            <h3>{{ $anime->title }}</h3>
            <!-- Exibindo a imagem do anime -->
            <img src="{{ asset('storage/img_itens/' . $anime->img_itens) }}" alt="Imagem de {{ $anime->title }}" class="img-fluid mb-3" style="height: 400px; object-fit: cover;>
            <p class="text-muted">Descrição: {{ $anime->description }}</p>
            <a href="{{ route('review.create', ['id' => $anime->id]) }}" class="btn btn-primary mt-3">Escrever uma Review</a>
        </div>

        <hr>

        <!-- Seção de Comentários -->
        <div class="comments-section">
            <h4>Comentários</h4>
            @forelse ($anime->reviews as $review)
                <div class="comment my-3">
                    <!-- Conteúdo do Comentário -->
                    <div class="comment-content text-start">
                        <!-- Nome do Usuário -->
                        <strong>{{ $review->user->name }}</strong><br>
                        <!-- Nota -->
                        <span class="text-muted">Nota: {{ $review->rating }} / 10</span><br>
                        <!-- Comentário -->
                        <p class="mt-1">{{ $review->comment }}</p>
                    </div>
                </div>
            @empty
                <p class="text-muted">Nenhum comentário disponível. Seja o primeiro a comentar!</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
