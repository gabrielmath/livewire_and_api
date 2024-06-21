<x-container.content-area>

  <div class="mb-6 flex justify-between">
    <h1 class="text-gray-800 dark:text-gray-300 text-2xl">
      Lista de Empresas -
      @if($usuario)
        {{ $usuario->nome }}
      @else
        Geral
      @endif
    </h1>
    <a
      wire:navigate
      href="{{ route('empresas.criar', ['usuario' => $usuario?->usuario_id]) }}"
      class="ms-4 p-1 text-sm flex items-center space-x-1 bg-gray-300 dark:bg-gray-700 dark:text-gray-200 rounded hover:bg-gray-100 dark:hover:bg-gray-600 transition-all"
    >
      <x-heroicon-s-plus class="h-5 w-5"/>
      <span>{{ __('Nova empresa') }}</span>
    </a>
  </div>

  <div class=" mb-4">
    <x-form.input
      wire:model.live="pesquisar"
      {{--                wire:keydown="search"--}}
      error-to="pesquisar"
      id="pesquisar"
      label="Pesquisar"
    />
  </div>

  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
      <tr>
        <th class="px-6 py-3">
          CNPJ
        </th>
        <th class="px-6 py-3">
          Nome fantasia
        </th>
        <th class="px-6 py-3">
          Razão social
        </th>
        <th class="px-6 py-3">
          Sócio Fundador
        </th>
        <th class="px-6 py-3">
          Action
        </th>
      </tr>
      </thead>
      <tbody class="bg-white border-b dark:bg-gray-700 dark:border-gray-700">
      @forelse($empresas as $empresa)
        <tr wire:key="{{ $empresa->empresa_id }}">
          <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
            {{ $empresa->cnpj }}
          </td>
          <td class="px-6 py-4">
            {{ $empresa->nome_fantasia }}
          </td>
          <td class="px-6 py-4">
            {{ $empresa->razao_social}}
          </td>
          <td class="px-6 py-4">
            {{ $empresa->usuario->nome }}
          </td>
          <td class="px-6 py-4 flex items-center space-x-2">
            {{--<livewire:usuario.editar-usuario :$user="$empresa" :$key="$empresa->id">
              Editar
            </livewire:usuario.editar-usuario>--}}
            <a
              wire:navigate
              href="{{ route('empresas.editar', ['empresa' => $empresa->empresa_id]) }}"
              class="p-1 rounded text-white bg-gray-600 dark:bg-gray-500 hover:bg-gray-400 dark:hover:bg-gray-400 transition-all"
              title="Editar"
            >
                <x-heroicon-s-pencil-square class="w-5 h-5"/>
            </a>

            {{--@if(auth()->user()->usuario_id !== $empresa->usuario_id)
                <livewire:usuario.excluir-usuario :$empresa :key="$empresa->usuario_id"/>
            @endif--}}
          </td>
        </tr>
      @empty
        <div>Nenhum registro encontrado</div>
      @endforelse
      </tbody>
    </table>
  </div>
</x-container.content-area>
