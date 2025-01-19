<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // listar reviews de um anime
    public function index()
{
    // obtem as reviews do usuário autenticado
    $reviews = Auth::user()->reviews;

    return view('perfil.reviews', compact('reviews'));
}

    // criar uma nova review
    public function create($animeId)
    {
        $anime = Anime::findOrFail($animeId);
        return view('review.create', compact('anime'));
    }

    // armazenar nova review
    public function store(Request $request, $animeId)
{
    // validação dos dados do formulário
    $request->validate([
        'comment' => 'required|string|max:255',
        'rating' => 'required|integer|min:1|max:10', // Verifique se você está coletando a classificação
    ]);

    // criação da nova review
    Review::create([
        'user_id' => auth()->id(), // certifica que o usuário está autenticado
        'anime_id' => $animeId,
        'comment' => $request->input('comment'),
        'rating' => $request->input('rating'), // verifique se você está coletando a classificação
    ]);

    // redirecionar para a página de reviews com uma mensagem de sucesso
    return redirect()->route('reviews.index')->with('success', 'Review adicionada com sucesso!');
}



    // editar uma review
    public function edit($id)
{
    // encontra a review pelo ID
    $review = Review::findOrFail($id);
    
    // encontra o anime relacionado à review
    $anime = Anime::findOrFail($review->anime_id);
    
    // retorne a view com a review e o anime
    return view('review.edit', compact('review', 'anime'));
}


    // atualiza review
    public function update(Request $request, $id)
{
    // validação dos dados do formulário
    $request->validate([
        'comment' => 'required|string|max:255',
        'rating' => 'required|integer|min:1|max:10', // verifique se você está coletando a classificação
    ]);

    // encontre a review pelo ID
    $review = Review::findOrFail($id);
    
    // atualize os campos da review
    $review->comment = $request->input('comment');
    $review->rating = $request->input('rating'); // verifique se você está coletando a classificação
    $review->save();

    // refireciona para a página de reviews com uma mensagem de sucesso
    return redirect()->route('reviews.index')->with('success', 'Review atualizada com sucesso!');
}

    // deletar uma review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        if (Auth::id() === $review->user_id || Auth::user()->is_admin) {
            $review->delete();
            return redirect()->route('reviews.index', $review->anime_id)->with('success', 'Review excluída com sucesso!');
        } else {
            return redirect()->route('reviews.index', $review->anime_id)->with('error', 'Sem permissão para excluir essa review.');
        }
    }
}
