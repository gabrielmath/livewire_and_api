<?php

namespace App\Livewire\Forms\Empresa;

use App\Models\Empresa;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditarEmpresaForm extends Form
{
    public ?Empresa $empresa = null;

    #[Validate(['required', 'numeric'])]
    public $usuario_id = null;

    #[Rule(['required', 'min:14', 'max:14', 'unique:empresas,cnpj'])]
    public ?string $cnpj = null;

    #[Validate(['required', 'min:3', 'max:100'])]
    public ?string $razao_social = null;

    #[Validate(['required', 'min:3', 'max:100'])]
    public ?string $nome_fantasia = null;

    public function setEmpresa(Empresa $empresa): void
    {
        $this->empresa = $empresa;
        $this->usuario_id = $empresa->usuario_id;
        $this->nome_fantasia = $empresa->nome_fantasia;
        $this->cnpj = $empresa->cnpj;
        $this->razao_social = $empresa->razao_social;
    }

    public function save(): void
    {
        $this->validateOnly('cnpj', [
            'cnpj' => ['required', 'min:14', 'max:14', "unique:empresas,cnpj,{$this->empresa->empresa_id},empresa_id"],
        ]);

        $this->validate();

        $this->empresa->update($this->except('empresa'));

        $this->reset();
    }
}
