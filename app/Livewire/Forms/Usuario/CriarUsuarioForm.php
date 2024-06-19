<?php

namespace App\Livewire\Forms\Usuario;

use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CriarUsuarioForm extends Form
{
    #[Rule(['required', 'min:3', 'max:100'])]
    public ?string $nome = null;

    #[Rule(['required', 'email', 'min:3', 'max:100'])]
    public ?string $email = null;

    #[Rule(['required', 'min:8', 'confirmed'])]
    public ?string $senha = null;

    #[Rule(['required', 'min:8'])]
    public ?string $senha_confirmation = null;

    public function save()
    {
        Auth::user();
        $this->validate();

        Usuario::create([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
        ]);

        $this->reset(['nome', 'email', 'senha', 'senha_confirmation']);
    }
}
