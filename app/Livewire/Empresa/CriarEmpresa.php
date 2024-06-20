<?php

namespace App\Livewire\Empresa;

use App\Livewire\Forms\Empresa\CriarEmpresaForm;
use Livewire\Component;

class CriarEmpresa extends Component
{
    public CriarEmpresaForm $form;

    public function render()
    {
        return view('livewire.empresa.criar-empresa');
    }

    public function submit()
    {

    }
}
