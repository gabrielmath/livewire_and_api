<?php

namespace App\Livewire\Forms\Empresa;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CriarEmpresaForm extends Form
{
    public ?string $cnpj = null;

    public ?string $razao_social = null;

    public ?string $nome_fantasia = null;

    public function save()
    {
        $this->validate();

//        Auth::user()->empresa()->create($this->all());
    }
}
