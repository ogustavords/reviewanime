<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    // Login do usuário
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Registro de novo usuário
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // Retorna a lista de animes
    public function getAnimes(Request $request)
{
    $search = $request->input('search', '');

    $query = Anime::query();
    if ($search) {
        $query->where('title', 'like', "%$search%");
    }

    $animes = $query->orderBy('created_at', 'desc')->get();

    // Adicionando o campo `img_url` a cada anime
    $animes->transform(function ($anime) {
        $anime->img_url = $anime->img_itens
            ? url("storage/img_itens/{$anime->img_itens}")
            : url("storage/img_itens/noimage.png");

        return $anime;
    });

    return response()->json($animes, 200);
}


    // Retorna detalhes de um anime
    public function getAnimeDetails($id)
{
    $anime = Anime::findOrFail($id);
    $anime->img_url = $anime->img_itens
        ? asset("storage/img_itens/{$anime->img_itens}")
        : asset("storage/img_itens/noimage.png");

    return response()->json($anime, 200);
}

// Retorna todas as reviews de um anime
public function getAnimeReviews($animeId)
{
    $anime = Anime::find($animeId);
    if (!$anime) {
        return response()->json(['error' => 'Anime não encontrado.'], 404);
    }

    $reviews = Review::where('anime_id', $animeId)->with('user')->get();

    return response()->json($reviews, 200);
}

    // Retorna as reviews do usuário autenticado
    public function getUserReviews()
    {
        $user = Auth::user();
        $reviews = $user->reviews()->with('anime')->get();

        return response()->json($reviews, 200);
    }

    // Cria uma nova review para um anime
    public function createReview(Request $request, $animeId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'anime_id' => $animeId,
            'comment' => $request->input('comment'),
            'rating' => $request->input('rating'),
        ]);

        return response()->json($review, 201);
    }

    // Atualiza uma review
    public function updateReview(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if (Auth::id() !== $review->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $review->update($request->only(['comment', 'rating']));

        return response()->json($review, 200);
    }

    // Remove uma review
    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);

        if (Auth::id() !== $review->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $review->delete();

        return response()->json(['message' => 'Review deleted'], 200);
    }

    // Retorna o perfil do usuário autenticado
    public function getUserProfile()
    {
        $user = Auth::user();

        return response()->json($user, 200);
    }
// Função de logout no ApiController
public function logout(Request $request)
{
    // Obtém o token do usuário atual
    $user = Auth::user();

    if ($user) {
        // Revoga o token atual
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Successfully logged out.'], 200);
    }

    return response()->json(['error' => 'No user logged in.'], 400);
}

    // Atualiza o perfil do usuário autenticado
    public function updateUserProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        return response()->json($user, 200);
    }
}