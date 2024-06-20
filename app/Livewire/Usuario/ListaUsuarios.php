<?php

namespace App\Livewire\Usuario;

use App\Models\Usuario;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

/**
 * @property-read Usuario $usuario
 */
class ListaUsuarios extends Component
{
    use WithPagination;

    #[Url]
    public string $pesquisar = '';

    #[On(['usuario-excluido'])]
    public function render()
    {
        return view('livewire.usuario.lista-usuarios', [
            'usuarios' => Usuario::where('nome', 'LIKE', "%{$this->pesquisar}%")->with('empresas')->paginate(5),
        ]);
    }

    public function search()
    {
        $this->resetPage();
    }
}
