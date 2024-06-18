<?php

namespace App\Livewire\Forms\Usuario;

use App\Models\Usuario;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditarUsuarioForm extends Form
{
    public ?Usuario $usuario;

    #[Rule(['required', 'min:3', 'max:100'])]
    public ?string $nome = null;

    public ?string $email = null;

    public function setUser(Usuario $usuario): void
    {
        $this->usuario = $usuario;
        $this->nome = $user->nome;
        $this->email = $user->email;
    }

    public function save(): void
    {
        $this->validateOnly('email', [
            'email' => ['required', 'string', 'email', "unique:users,email,{$this->usuario->id},id"],
        ]);

        $this->validate();

        $this->usuario->update([
            'nome' => $this->nome,
            'email' => $this->email,
        ]);

        $this->reset(['usuario', 'nome', 'email']);
    }
}
