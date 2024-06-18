<?php

namespace App\Livewire\Forms\Usuario;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditarUsuarioForm extends Form
{
    public ?User $user;

    #[Rule(['required', 'min:3', 'max:100'])]
    public ?string $name = null;

    public ?string $email = null;

    public function setUser(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save(): void
    {
        $this->validateOnly('email', [
            'email' => ['required', 'string', 'email', "unique:users,email,{$this->user->id},id"],
        ]);

        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->reset(['user', 'name', 'email']);
    }
}
