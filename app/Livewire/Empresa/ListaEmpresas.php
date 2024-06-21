<?php

namespace App\Livewire\Empresa;

use App\Models\Empresa;
use App\Models\Usuario;
use Illuminate\Database\Query\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;

/**
 * @property-read Usuario $usuario
 * @property-read Empresa $empresa
 */
class ListaEmpresas extends Component
{
    #[Url]
    public ?string $pesquisar = null;

    public ?Usuario $usuario = null;

//    public          $empresas;

    public function mount($usuario = null)
    {
        $this->usuario = $usuario;
    }

    public function render()
    {
        $empresas = Empresa::with('usuario');
        $linkCriarEmpresa = route('empresas.criar');

        if ($this->usuario) {
            $empresas->when($this->usuario, function ($query, Usuario $usuario) {
                $query->where('usuario_id', $usuario->usuario_id);
            });

            $linkCriarEmpresa = route('empresas.criar', ['usuario' => $this->usuario->usuario_id]);
        }


        $empresas
            ->when($this->pesquisar, function ($query, $pesquisar) {
                $query->where('cnpj', 'LIKE', "%{$pesquisar}%")
                    ->orWhere('nome_fantasia', 'LIKE', "%{$pesquisar}%")
                    ->orWhere('razao_social', 'LIKE', "%{$pesquisar}%")
                    ->orWhereHas('usuario', function ($q) use ($pesquisar) {
                        $q->where('nome', 'LIKE', "%{$pesquisar}%");
                    });
            });


        return view('livewire.empresa.lista-empresas', [
            'linkCriarEmpresa' => $linkCriarEmpresa,
            'empresas' => $empresas->get(),
        ]);
    }

    /*public function criar(?int $usuario_id = null): void
    {
        $this->dispatch('criar-empresa', usuario_id: $usuario_id);
    }

    public function editar(int $empresa_id): void
    {
        $this->dispatch('editar-empresa', empresa_id: $empresa_id);
    }*/
}
