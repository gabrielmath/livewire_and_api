<?php

namespace App\Livewire\Empresa;

use App\Livewire\Forms\Empresa\EditarEmpresaForm;
use App\Models\Empresa;
use App\Models\Usuario;
use Livewire\Component;

class EditarEmpresa extends Component
{
    public EditarEmpresaForm $form;

    public Empresa $empresa;

    public function mount(Empresa $empresa)
    {
        $this->empresa = $empresa;
        $this->form->setEmpresa($empresa);
    }

    public function render()
    {
        return view('livewire.empresa.editar-empresa', [
            'usuarios' => Usuario::get()
        ]);
    }

    public function submit()
    {
        $this->form->save();

        return redirect()->route('empresas.listar', ['usuario' => $this->empresa->usuario]);
    }
}
