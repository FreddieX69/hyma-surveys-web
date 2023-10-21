@props([
    'name',
    'label',
    'value',
    'type' => 'text',
    'min' => null,
    'max' => null,
    'step' => null,
    'required'
])

@if($label ?? null)
    @include('components.inputs.partials.label')
@endif

<input
    type="{{ $type }}"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ old($name, $value ?? '') }}"
    {{ $attributes->merge(['class' => 'form-control']) }}
    {{ $min ? "min={$min}" : '' }}
    {{ $max ? "max={$max}" : '' }}
    {{ $step ? "step={$step}" : '' }}
    autocomplete="off"
>

@error($name)
    @include('components.inputs.partials.error')
@enderror
