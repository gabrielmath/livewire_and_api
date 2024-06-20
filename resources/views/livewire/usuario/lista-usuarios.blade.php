<x-container.content-area>
    <div class="mb-6 flex justify-between">
        <h1 class="text-gray-800 dark:text-gray-300 text-2xl">
            Lista de Usuários
        </h1>
        <a
                wire.navigate
                href="{{ route('usuarios.criar') }}"
                class="ms-4 p-1 text-sm flex items-center space-x-1 bg-gray-300 dark:bg-gray-700 dark:text-gray-200 rounded hover:bg-gray-100 dark:hover:bg-gray-600 transition-all"
        >
            <x-heroicon-s-plus class="h-5 w-5"/>
            <span>{{ __('Novo usuário') }}</span>
        </a>
    </div>

    <div class=" mb-4">
        <x-form.input
                wire:model.live="pesquisar"
                wire:keydown="search"
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
                    Nome
                </th>
                <th class="px-6 py-3">
                    E-mail
                </th>
                <th class="px-6 py-3">
                    Total empresas
                </th>
                <th class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody class="bg-white border-b dark:bg-gray-700 dark:border-gray-700">
            @forelse($usuarios as $usuario)
                <tr wire:key="{{ $usuario->usuario_id }}">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                        {{ $usuario->nome }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $usuario->email }}
                    </td>
                    <td class="px-6 py-4">
                        <a
                                wire:navigate href="{{ route('empresas.listar', ['usuario' => $usuario->usuario_id]) }}"
                                class="text-blue-400 hover:text-blue-600 transition-all"
                        >
                            Possui {{ $usuario->empresas()->count() }}
                        </a>
                    </td>
                    <td class="px-6 py-4 flex items-center space-x-2">
                        {{--<livewire:usuario.editar-usuario :$user="$usuario" :$key="$usuario->id">
                          Editar
                        </livewire:usuario.editar-usuario>--}}
                        <a
                                wire:navigate
                                href="{{ route('usuarios.editar', ['usuario' => $usuario->usuario_id]) }}"
                                class="p-1 rounded text-white bg-gray-600 dark:bg-gray-500 hover:bg-gray-400 dark:hover:bg-gray-400 transition-all"
                                title="Editar"
                        >
                            <x-heroicon-s-pencil-square class="w-5 h-5"/>
                        </a>

                        @if(auth()->user()->usuario_id !== $usuario->usuario_id)
                            <livewire:usuario.excluir-usuario :$usuario :key="$usuario->usuario_id"/>
                        @endif
                    </td>
                </tr>
            @empty
                <div>Nenhum registro encontrado</div>
            @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $usuarios->links() }}
        </div>
    </div>
</x-container.content-area>
