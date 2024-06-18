<div class="pt-16">
  <div class="mb-6 flex justify-end">
    <a href="{{ route('criar-usuarios') }}" wire.navigate class="ms-4">
      {{ __('Register') }}
    </a>
  </div>

  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th class="px-6 py-3">
          Nome
        </th>
        <th class="px-6 py-3">
          E-mail
        </th>
        <th class="px-6 py-3">
          Action
        </th>
      </tr>
      </thead>
      <tbody>
      @forelse($usuarios as $usuario)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
          <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
            {{ $usuario->nome }}
          </td>
          <td class="px-6 py-4">
            {{ $usuario->email }}
          </td>
          <td class="px-6 py-4">
            {{--<livewire:usuario.editar-usuario :$user="$usuario" :$key="$usuario->id">
              Editar
            </livewire:usuario.editar-usuario>--}}
            <a href="{{ route('editar-usuario', $usuario->id) }}"
               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
          </td>
        </tr>
      @empty
        <div>Nenhum registro encontrado</div>
      @endforelse
      </tbody>
    </table>
  </div>
</div>
