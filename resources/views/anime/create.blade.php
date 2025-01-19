<x-app-layout>
    <link rel="stylesheet" href="{{ asset('estilo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Anime') }}
        </h2>
    </x-slot>

    <div class="container w-auto p-3">
        <form action="{{ route('anime.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <strong>Imagem para o produto:</strong>
                <input type="file" name="img_itens" id="img_itens" class="form-control wd custom-file-input" placeholder="Entre com um nome" required>
                <label class="custom-file-label" for="img_itens">Escolher arquivo</label>
            </div>
            <button type="submit" class="button">Criar Anime</button>
        </form>
    </div>
</x-app-layout>
