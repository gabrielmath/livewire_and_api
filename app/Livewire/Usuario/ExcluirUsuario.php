<?php

namespace App\Livewire\Usuario;

use App\Models\Usuario;
use Livewire\Component;

class ExcluirUsuario extends Component
{
    public ?Usuario $usuario = null;

    public function mount(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function render()
    {
        return view('livewire.usuario.excluir-usuario');
    }

    public function excluir(): void
    {
        $this->usuario->delete();

        $this->dispatch('usuario-excluido');
    }
}
