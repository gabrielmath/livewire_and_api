<?php

namespace App\Livewire\Usuario;

use App\Models\Usuario;
use Livewire\Component;

/**
 * @property-read Usuario $usuario
 */
class ListaUsuarios extends Component
{
    public $usuarios = null;

    public function render()
    {
        $this->usuarios = Usuario::get();
        return view('livewire.usuario.lista-usuarios');
    }
}
