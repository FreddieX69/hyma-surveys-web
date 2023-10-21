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
        $this->headers = $headers;
        $this->items = $items;
    }

    public function array(): array
    {
        $patient_forms = PatientForm::find($this->items);
        $array_export = [$this->headers];
        foreach ($patient_forms as $patient_form) {
            $responses = $patient_form->formResponses()->pluck('answer', 'id')->toArray();
            $array_export[] = $responses;
        }
        return $array_export;
    }
}
