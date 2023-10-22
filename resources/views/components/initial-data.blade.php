@props([
    'value',
    'type',
    'id'
])
@if($type == 1)
    @if($value == 0)
        <div>
            No <a class="btn btn-sm btn-primary" href="{{ route('fill-form',  ['form_type' => 1, 'patient_id' => $id]) }}" target="_blank" title="Ver Foto">Realizar</a>
        </div>
    @else
        <div>
            Sí
        </div>
    @endif
@elseif($type == 2)
    @if($value == 0)
        <div>
            No <a class="btn btn-sm btn-primary" href="{{ route('fill-form',  ['form_type' => 2, 'patient_id' => $id]) }}" target="_blank" title="Ver Foto">Realizar</a>
        </div>
    @else
        <div>
            Sí
        </div>
    @endif
@elseif($type == 3)
    @if($value == 0)
        <div>
            No <a class="btn btn-sm btn-primary" href="{{ route('fill-form',  ['form_type' => 3, 'patient_id' => $id]) }}" target="_blank" title="Ver Foto">Realizar</a>
        </div>
    @else
        <div>
            Sí
        </div>
    @endif
@else
    @if($value == 0)
        <div>
            No <a class="btn btn-sm btn-primary" href="{{ route('fill-form',  ['form_type' => 4, 'patient_id' => $id]) }}" target="_blank" title="Ver Foto">Realizar</a>
        </div>
    @else
        <div>
            Sí
        </div>
    @endif
@endif


