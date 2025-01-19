<?php
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [AnimeController::class, 'dashboard'])->name('dashboard');
    
    // Rota para listar animes
    Route::get('/anime', [AnimeController::class, 'index'])->name('animes.index');
    
    // Rota para criar novo anime (admin)
    Route::get('/anime/create', [AnimeController::class, 'create'])->name('anime.create');
    Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');
    Route::delete('/anime/{id}', [AnimeController::class, 'destroy'])->name('anime.destroy');

    // Rota para detalhes do anime
    Route::get('/anime/{id}', [AnimeController::class, 'details'])->name('anime.details');

    // Rotas para reviews
    Route::get('/perfil/reviews', [ReviewController::class, 'index'])->name('reviews.index'); // Rota para listar reviews
    // Rotas para reviews
Route::get('/anime/{id}/review', [ReviewController::class, 'create'])->name('review.create');
Route::post('/anime/{id}/review', [ReviewController::class, 'store'])->name('review.store');

    Route::get('/perfil/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/perfil/reviews/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/perfil/reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

    // Rotas perfil
    Route::get('/perfil', [ProfileController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/edit', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('perfil.update');
});
