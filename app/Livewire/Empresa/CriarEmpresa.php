<?php

namespace App\Livewire\Empresa;

use App\Livewire\Forms\Empresa\CriarEmpresaForm;
use App\Models\Usuario;
use Livewire\Component;

/**
 * @property-read Usuario $usuario
 */
class CriarEmpresa extends Component
{
    public CriarEmpresaForm $form;

    public ?Usuario $usuario = null;
    public function mount(?Usuario $usuario = null)
    {
        $this->usuario = $usuario;
        $this->form->setUser($usuario->usuario_id);
    }

    public function render()
    {
        return view('livewire.empresa.criar-empresa', [
            'usuarios' => Usuario::get()
        ]);
    }

    public function submit()
    {
        $usuario_id_selecionado = $this->form->usuario_id;
        $this->form->save();

        $this->redirect(route('empresas.listar', ['usuario' =>$usuario_id_selecionado]));
    }
}
