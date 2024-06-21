<?php

namespace App\Livewire\Usuario;

use App\Models\Usuario;
use Livewire\Component;

class ExcluirUsuario extends Component
{
    public Usuario $usuario;

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
        if ($this->usuario->empresas()->count() > 0) {
            $this->js("alert('Usuário com empresa não poderá ser excluído!')");
            return;
        }

        $this->usuario->delete();

        $this->js("alert('Usuário excluído com sucesso!')");

        $this->dispatch('usuario-excluido');
    }
}
