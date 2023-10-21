@props([
    'name',
    'label',
    'size',
    'required'
])

@if($label ?? null)
    @include('components.inputs.partials.label')
@endif

<select class="form-select" size="{{ $size }}"  {{ $attributes->merge(['class' => 'form-control']) }} id="{{ $name }}">
    {{ $slot }}
</select>

@error($name)
    @include('components.inputs.partials.error')
@enderror
