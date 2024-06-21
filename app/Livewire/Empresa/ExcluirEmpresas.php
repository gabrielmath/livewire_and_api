<?php

namespace App\Livewire\Empresa;

use App\Models\Empresa;
use Livewire\Component;

class ExcluirEmpresas extends Component
{
    public Empresa $empresa;

    public function mount(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }

    public function render()
    {
        return view('livewire.empresa.excluir-empresas');
    }

    public function excluir(): void
    {
        $this->empresa->delete();

        $this->js("alert('Empresa excluída com sucesso!')");

        $this->dispatch('empresa-excluida');
    }
}
