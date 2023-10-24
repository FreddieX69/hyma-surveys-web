@props([
    'id'
])
<button
    class="btn btn-sm btn-primary"
    wire:click="$dispatch('edit', { id: '{{ $id }}' })"
    title="Editar">
    <i class="bi bi-pencil-square"></i>
</button>
<button
    class="btn btn-sm btn-danger"
    wire:confirm="Está a punto de eliminar este registro de forma permanente, ¿Está seguro?"
    wire:click="$dispatch('delete', { id: '{{ $id }}' })"
    title="Editar">
    <i class="bi bi-trash"></i>
</button>
