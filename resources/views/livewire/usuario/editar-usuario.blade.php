<x-container.content-area>
  <form wire:submit="submit">
    <!-- Name -->
    <x-form.input wire:model="form.nome" error-to="form.nome" id="nome" label="Nome" required />

    <!-- Email Address -->
    <x-form.input wire:model="form.email" error-to="form.email" type="email" id="email" label="E-mail" required />

{{--    @dd($form)--}}

    <div class="flex items-center justify-end mt-4">

      <x-primary-button class="ms-4">
        {{ __('Salvar') }}
      </x-primary-button>
    </div>
  </form>
</x-container.content-area>
