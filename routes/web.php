<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacaoController;
use Illuminate\Support\Facades\Route;

// Rota para a tela inicial
Route::get('/', [PublicacaoController::class, 'index'])->name('home');


// Rotas para o gerenciamento do perfil do usuário, apenas usuários autenticados têm acesso
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rota para exibir o formulário de publicação, apenas usuários autenticados têm acesso
    Route::get('/publicar', [PublicacaoController::class, 'create'])->name('publicar');
    // Rota para armazenar a publicação, apenas usuários autenticados têm acesso
    Route::post('/publicar', [PublicacaoController::class, 'store'])->name('publicar.store');
    
    // Rotas para aprovação e rejeição de publicações, apenas usuários autenticados têm acesso
    Route::patch('/publicacoes/{id}/aprovar', [PublicacaoController::class, 'approve'])->name('aprovar');
    Route::patch('/publicacoes/{id}/rejeitar', [PublicacaoController::class, 'reject'])->name('rejeitar');

        
    Route::get('/dashboard', [PublicacaoController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

});


require __DIR__.'/auth.php';
