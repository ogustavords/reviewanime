<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController; 
// Rotas públicas
Route::post('/login', [ApiController::class, 'login']);
Route::post('/register', [ApiController::class, 'register']);
// Rotas protegidas por autenticação
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiController::class, 'logout']);
// Rotas para Animes
    Route::get('/animes', [ApiController::class, 'getAnimes']);
    Route::get('/animes/{id}', [ApiController::class, 'getAnimeDetails']);
// Rotas para Reviews
    Route::get('/reviews', [ApiController::class, 'getUserReviews']);
    Route::get('/animes/{id}/reviews', [ApiController::class, 'getAnimeReviews']);
    Route::post('/animes/{id}/reviews', [ApiController::class, 'createReview']);
    Route::put('/reviews/{id}', [ApiController::class, 'updateReview']);
    Route::delete('/reviews/{id}', [ApiController::class, 'deleteReview']);
// Rotas para Perfil do Usuário
    Route::get('/profile', [ApiController::class, 'getUserProfile']);
    Route::put('/profile', [ApiController::class, 'updateUserProfile']);
});
