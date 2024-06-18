<?php

use App\Livewire\Usuario\CriarUsuario;
use App\Livewire\Usuario\EditarUsuario;
use Illuminate\Support\Facades\Route;
use App\Livewire\Usuario\ListaUsuarios;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/usuarios', ListaUsuarios::class)->name('lista-usuarios');
Route::get('/criar-usuarios', CriarUsuario::class)->name('criar-usuarios');
Route::get('/editar-usuario/{user}', EditarUsuario::class)->name('editar-usuario');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
