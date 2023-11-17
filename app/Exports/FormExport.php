<?php

namespace App\Exports;

use App\Models\PatientForm;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormExport implements FromArray, ShouldAutoSize
{

    public $headers, $items;

    public function __construct($headers, $items)
    {
        $default = [
            'Nombre del paciente',
            'Correo electrónico',
            'Tipo de paciente',
        ];
        $this->headers = $default + $headers;
        $this->items = $items;
    }

    public function array(): array
    {
        $patient_forms = PatientForm::find($this->items);
        $array_export = [$this->headers];
        foreach ($patient_forms as $patient_form) {
            $patient = [
                $patient_form->patient->name,
                $patient_form->patient->email,
                $patient_form->patient->type == 1 ? 'Adulto' : 'Niño',
            ];
            $responses = $patient_form->formResponses()->orderBy('field_id')->get();
            $array_response = [];
            foreach ($responses as $response) {
                if ($response->field->type == 6) {
                    $item = $response->field_answer?->description;
                } elseif ($response->field->type == 5) {
                    $item = $response->answer == 1 ? 'Sí' : 'No';
                } else {
                    $item = $response->answer;
                }
                $array_response[$response->field->id] = $item;
            }
            $array_export[] = $patient + $array_response;
        }
        return $array_export;
    }
}
