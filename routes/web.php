<?php

use App\Livewire\Home\PainelPrincipal;
use App\Livewire\Usuario\CriarUsuario;
use App\Livewire\Usuario\EditarUsuario;
use Illuminate\Support\Facades\Route;
use App\Livewire\Usuario\ListaUsuarios;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', PainelPrincipal::class)->name('dashboard');
    Route::prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/', ListaUsuarios::class)->name('listar');
        Route::get('/criar', CriarUsuario::class)->name('criar');
        Route::get('/{usuario}/editar', EditarUsuario::class)->name('editar');
    });
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
