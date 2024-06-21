<?php

use App\Livewire\Actions\Logout;
use App\Livewire\Empresa\CriarEmpresa;
use App\Livewire\Empresa\EditarEmpresa;
use App\Livewire\Empresa\ListaEmpresas;
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

    Route::prefix('empresas')->name('empresas.')->group(function () {
        Route::get('/listar/{usuario?}', ListaEmpresas::class)->name('listar');
        Route::get('/criar/{usuario?}', CriarEmpresa::class)->name('criar');
        Route::get('/{empresa}/editar', EditarEmpresa::class)->name('editar');
    });

    Route::get('logout', Logout::class)->name('logout');
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
