<label class="{{ ($required ?? false) ? 'label label-required ' : 'label ' }}" for="{{ $name }}">
    <strong>{{ $label }} {{ ($required ?? false) ? '*' : '' }}</strong>
</label>
