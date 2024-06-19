<?php

namespace App\Livewire\Usuario;

use App\Livewire\Forms\Usuario\CriarUsuarioForm;
use Livewire\Component;

class CriarUsuario extends Component
{
    public CriarUsuarioForm $form;

    public function render()
    {
        return view('livewire.usuario.criar-usuario');
    }

    public function submit()
    {
//        $this->form->validate();
        $this->form->save();

        return redirect()->route('usuarios.listar');
    }
}
