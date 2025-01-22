<x-app-layout>
    <link rel="stylesheet" href="{{ asset('estilo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Detalhes do Anime') }}: {{ $anime->title }}
        </h2>
    </x-slot>

    <div class="container my-5">
        <!-- Botão de apagar (somente para admin) -->
        @if(Auth::check() && Auth::user()->is_admin)
            <form action="{{ route('anime.destroy', ['id' => $anime->id]) }}" method="POST" class="position-relative">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger position-absolute" style="top: 0; right: 0;">
                    Apagar Anime
                </button>
            </form>
        @endif

        <!-- Detalhes do Anime -->
        <div class="anime-details text-center mb-5">
            <h3>{{ $anime->title }}</h3>
            <!-- Exibindo a imagem do anime com flexbox -->
            <div class="anime-image d-flex justify-content-center">
                <img src="{{ asset('storage/img_itens/' . $anime->img_itens) }}" alt="Imagem de {{ $anime->title }}" class="img-fluid mb-3" style="max-width: 100%; height: 400px; object-fit: cover;">
            </div>
            <p class="text-muted">Descrição: {{ $anime->description }}</p>
            <a href="{{ route('review.create', ['id' => $anime->id]) }}" class="btn btn-primary mt-3">Escrever uma Review</a>
        </div>

        <hr>

        <!-- Média de Avaliação -->
        <div class="rating-average text-center mb-5">
            @php
                $averageRating = $anime->reviews->avg('rating');
                $halfStars = round($averageRating / 2);  // Dividindo a média por 2
            @endphp

            <h4 class="text-primary">Média de Avaliação:</h4>
            <div class="star-rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $halfStars)
                        <span class="star filled">★</span>  <!-- Estrela cheia -->
                    @elseif ($i - 0.5 <= $halfStars)
                        <span class="star half-filled">★</span> <!-- Estrela meia cheia -->
                    @else
                        <span class="star">★</span> <!-- Estrela vazia -->
                    @endif
                @endfor
            </div>
            <p class="text-muted">{{ number_format($averageRating, 1) }} / 10</p>
        </div>

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

    <style>
        .star-rating {
            display: inline-block;
            color: gold;
            font-size: 1.5rem;
        }
        .star {
            margin-right: 3px;
        }
        .star.filled {
            color: gold;
        }
        .star.half-filled {
            color: #FFD700;
            position: relative;
        }
        .star.half-filled:after {
            content: '★';
            position: absolute;
            top: 0;
            left: 0;
            color: #d3d3d3;
        }
        .star:not(.filled):not(.half-filled) {
            color: #d3d3d3;
        }
    </style>
</x-app-layout>
