<x-container.content-area>
  <form wire:submit="submit">
    <!-- Name -->
    <x-form.input wire:model="form.nome" error-to="form.nome" id="nome" label="Nome" required/>

    <!-- Email Address -->
    <x-form.input wire:model="form.email" error-to="form.email" type="email" id="email" label="E-mail" required/>

    <!-- Password -->
    <x-form.input wire:model="form.senha" error-to="form.senha" type="password" id="password" label="Senha" required/>

    <!-- Confirm Password -->
    <x-form.input
      wire:model="form.senha_confirmation"
      error-to="form.senha_confirmation"
      type="password"
      id="password_confirmation"
      label="Confirme a senha"
      required
    />

    <div class="flex items-center justify-end mt-4">
      <x-primary-button class="ms-4">
        {{ __('Cadastrar') }}
      </x-primary-button>
    </div>
  </form>
</x-container.content-area>
