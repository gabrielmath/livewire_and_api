<?php

namespace App\Livewire\Usuario;

use App\Livewire\Forms\Usuario\EditarUsuarioForm;
use App\Models\Usuario;
use Livewire\Component;

class EditarUsuario extends Component
{
    public EditarUsuarioForm $form;

    public function render()
    {
        return view('livewire.usuario.editar-usuario');
    }

    public function mount(Usuario $usuario)
    {
        $this->form->setUser($usuario);
    }

    public function submit()
    {
//        $this->form->validate();
        $this->form->save();

        return redirect()->route('usuarios.listar');
    }
}
