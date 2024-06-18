<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use Livewire\Component;

/**
 * @property-read User $usuario
 */
class ListaUsuarios extends Component
{
    public $usuarios = null;
    public function render()
    {
        $this->usuarios = User::get();
        return view('livewire.usuario.lista-usuarios');
    }
}
