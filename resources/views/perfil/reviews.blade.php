<x-app-layout>
<link rel="stylesheet" href="{{asset('estilo.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minhas Reviews') }}
        </h2>
    </x-slot>

    <div class="container">
        @foreach ($reviews as $review)
        <div class="card">
            <div class="card-title">Review {{ $loop->iteration }}</div>
            <div class="card-description">{{ $review->comment }}</div> <!-- Altere para 'comment' -->
            <div class="card-rating">Classificação: {{ $review->rating }} / 10</div> <!-- Adicione a linha para exibir a classificação -->
            <div class="text-right">
                <a href="{{ route('review.edit', ['id' => $review->id]) }}" class="button mr-2">Editar</a>
                <form action="{{ route('review.destroy', ['id' => $review->id]) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button">Excluir</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
