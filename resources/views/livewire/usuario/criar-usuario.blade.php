<div class="pt-16">
  <form wire:submit="submit">
    <!-- Name -->
    <div>
      <x-input-label for="name" :value="__('Name')"/>
      <x-text-input wire:model="form.nome" id="name" class="block mt-1 w-full" type="text" name="name" required
                    autofocus autocomplete="name"/>
      <x-input-error :messages="$errors->get('form.nome')" class="mt-2"/>
    </div>

    <!-- Email Address -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')"/>
      <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required
                    autocomplete="username"/>
      <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')"/>

      <x-text-input wire:model="form.senha" id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password"/>

      <x-input-error :messages="$errors->get('form.senha')" class="mt-2"/>
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

      <x-text-input wire:model="form.senha_confirmation" id="password_confirmation" class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password"/>

      <x-input-error :messages="$errors->get('form.senha_confirmation')" class="mt-2"/>
    </div>

    <div class="flex items-center justify-end mt-4">
      <a
        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
        href="{{ route('login') }}" wire:navigate>
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ms-4">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</div>
