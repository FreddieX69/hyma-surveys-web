@props([
    'name',
    'label',
    'value',
])

<x-inputs.basic type="text" :name="$name" label="{{ $label ?? ''}}" :value="$value ?? ''" :attributes="$attributes" maxlength="255"></x-inputs.basic>
