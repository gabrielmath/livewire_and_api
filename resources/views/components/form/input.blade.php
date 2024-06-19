@props([
    'errorTo',
    'label',
    'id',
    'type' => 'text',
    'disabled' => false,
    'required' => false
])

<div {{ $attributes->merge(['class' => 'mt-4']) }}>
  <label for="{{ $id }}" class="form-label {{ $errors->has($errorTo) ? 'label-error' : '' }}">
    {{ $label }}
  </label>

  <input
    {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : '' }}
    type="{{ $type }}"
    id="{{ $id }}"
    class="form-input {{ $errors->has($errorTo) ? 'input-error' : '' }}"
    {{ $attributes->merge(['wire:model' => '']) }}
  />
  <x-input-error :messages="$errors->get($errorTo)" class="mt-2"/>
</div>
