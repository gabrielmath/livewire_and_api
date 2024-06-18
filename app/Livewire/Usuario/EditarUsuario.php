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

    public function mount(Usuario $user)
    {
        $this->form->setUser($user);
    }

    public function submit()
    {
//        $this->form->validate();
        $this->form->save();

        return redirect()->route('lista-usuarios');
    }
}
