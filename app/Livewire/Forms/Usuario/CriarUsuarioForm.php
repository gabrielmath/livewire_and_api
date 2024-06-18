<?php

namespace App\Livewire\Forms\Usuario;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CriarUsuarioForm extends Form
{
    #[Rule(['required', 'min:3', 'max:100'])]
    public ?string $name = null;

    #[Rule(['required', 'email', 'min:3', 'max:100'])]
    public ?string $email = null;

    #[Rule(['required', 'min:8', 'confirmed'])]
    public ?string $password = null;

    #[Rule(['required', 'min:8'])]
    public ?string $password_confirmation = null;

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $this->reset(['name', 'email', 'password', 'password_confirmation']);
    }
}
