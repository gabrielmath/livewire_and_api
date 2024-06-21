<?php

namespace App\Livewire\Forms\Empresa;

use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CriarEmpresaForm extends Form
{
    #[Validate(['required', 'numeric'])]
    public $usuario_id = null;

    #[Validate(['required', 'min:14', 'max:14', 'unique:empresas,cnpj'])]
    public ?string $cnpj = null;

    #[Validate(['required', 'min:3', 'max:100'])]
    public ?string $razao_social = null;

    #[Validate(['required', 'min:3', 'max:100'])]
    public ?string $nome_fantasia = null;


    public function setUser($usuario_id = null): void
    {
        $this->usuario_id = $usuario_id;
    }

    public function save(): void
    {
        $this->validate();

        Empresa::create($this->all());

        $this->reset();
    }
}
