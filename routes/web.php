<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicacaoController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/publicar', [PublicacaoController::class, 'create'])->name('publicar.create');
    Route::post('/publicar', [PublicacaoController::class, 'store'])->name('publicar.store');
    Route::get('/dashboard', [PublicacaoController::class, 'dashboard'])->name('dashboard');
    Route::patch('/publicacao/{id}/aprovar', [PublicacaoController::class, 'approve'])->name('publicacao.approve'); 
    Route::patch('/publicacao/{id}/rejeitar', [PublicacaoController::class, 'reject'])->name('publicacao.reject');
});


require __DIR__.'/auth.php';
