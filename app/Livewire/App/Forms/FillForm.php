<?php

namespace App\Livewire\App\Forms;

use App\Models\Form;
use App\Models\Patient;
use App\Models\PatientForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FillForm extends Component
{
    use WithFileUploads;
    public $form_type;
    public Form $form;
    public ?Patient $patient;
    public PatientForm $patientForm;

    public $name, $email, $phones, $type, $load_form = false, $form_fields = [], $validation_rules = [];
    public function mount($form_type, ? int $patient_id = null): void
    {
        $this->type = 1;
        $this->form_type = $form_type;
        $this->patient = Patient::find($patient_id);
        if ($this->patient) {
            $this->name = $this->patient->name;
            $this->email = $this->patient->email;
            $this->type = $this->patient->type;

            //TODO: QUITAR ESTO ALV - ES SOLO PARA PROBAR
            $this->form = Form::find(1);
            $this->prepareForm();
        }
    }

    public function prepareForm(): void
    {
        if ($this->form ?? null) {
            foreach ($this->form->fields as $field) {
                $required = $field->required ? 'required' : 'nullable';
                $this->form_fields[$field->id] = null;
                $model = 'form_fields.'.$field->id;
                $this->form_fields[$field->id] = null;
                $validation = match ($field->type) {
                    0 => ['string', 'max:191'],
                    1 => ['string'],
                    2 => ['numeric'],
                    3 => ['date'],
                    4 => ['file', 'mimes:jpg,gif,png'],
                    5 => ['boolean'],
                    6 => ['int'],
                    default => 'string',
                };
                $this->validation_rules[$model] = array_merge([$required], $validation);
            }
        }
    }

    public function savePatient(): void
    {
        $validate = $this->validate([
            'name' => ['required', 'string'],
            'email' => ['nullable', 'email'],
            'type' => ['required', 'int', 'between:1,2'],
        ]);

        if ($this->patient ?? null) {
            $this->patient->update($validate);
        } else {
            $this->patient = Patient::create($validate);
        }
        if ($this->form_type == 1) {
            // Cuando es una ficha inicial médica
            $id = $this->patient->type == 1 ? 1 : 2;
            $this->form = Form::find($id);
        }
    }

    public function finishForm(): void
    {
        $this->validate($this->validation_rules);
        if (!($this->patientForm ?? null)) {
            $this->patientForm = PatientForm::create([
                'patient_id' => $this->patient->id,
                'status' => 2,
                'user_id' => auth()->id(),
                'form_id' => $this->form->id,
            ]);
        }
        foreach ($this->form_fields as $field_id => $field_response) {
            $field = $this->form->fields()->find($field_id);
            $array = [];
            $array['field_id'] = $field->id;
            if ($field->type == 6) {
                // Respuesta seleccionable
                $array['field_answer_id'] = $field_response;
            } elseif ($field->type == 4) {
                // Fotografía
                if (!Storage::exists('images')) {
                    Storage::makeDirectory('images');
                }
                $array['answer'] = Storage::put('images', $field_response);
            } else {
                // Cualquier otro tipo de respuesta
                $array['answer'] = $field_response;
            }
            $this->patientForm->formResponses()->create($array);
        }
        $this->patient->initial_data = 1;
        $this->patient->save();
        $this->dispatch('toast-notify',
            type: 'success',
            message: 'Formulario finalizado correctamente'
        );
        $this->redirectRoute('initial-data-medic');
    }

    public function render(): View
    {
        return view('livewire.app.forms.fill-form');
    }
}
