<x-container.content-area>
  <form wire:submit="submit">
    <div class="w-full flex items-center space-x-4">
      <div class="mt-4 w-full md:w-1/2">
        <label for="usuario" class="form-label {{ $errors->has('form.usuario_id') ? 'label-error' : '' }}">
          Sócio Proprietário
        </label>
        {{--        @dd($form->usuario_id)--}}
        <select
          wire:model="form.usuario_id"
          id="usuario"
          class="form-input {{ $errors->has('form.usuario_id') ? 'input-error' : '' }}"
        >
          {{--          <option disabled>Selecione...</option>--}}
          @foreach($usuarios as $usuario)
            <option value="{{ $usuario->usuario_id }}">{{ $usuario->nome }}</option>
          @endforeach
        </select>
        <x-input-error :messages="$errors->get('form.usuario_id')" class="mt-2"/>
      </div>

      <x-form.input wire:model="form.cnpj" error-to="form.cnpj" id="cnpj" label="CNPJ" class="w-full md:w-1/2" required/>
    </div>

    <!-- Email Address -->
    <x-form.input wire:model="form.razao_social" error-to="form.razao_social" id="razao_social" label="Razão Social" required/>

    <!-- Password -->
    <x-form.input wire:model="form.nome_fantasia" error-to="form.nome_fantasia" id="nome_fantasia" label="Nome Fantasia" required/>


    <div class="flex items-center justify-end mt-4">
      <x-primary-button class="ms-4">
        {{ __('Salvar') }}
      </x-primary-button>
    </div>
  </form>
</x-container.content-area>
