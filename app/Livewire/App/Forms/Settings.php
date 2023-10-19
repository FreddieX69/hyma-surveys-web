<?php

namespace App\Livewire\App\Forms;

use App\Enums\FieldTypes;
use App\Models\Field;
use App\Models\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Settings extends Component
{
    public $form_initial_data, $form_socio_economic_study, $alert, $field = [], $field_answer, $modal_edit = false,
            $answerEdit;
    public ?Form $form;
    public ?Field $fieldEdit;
    public Collection $fieldTypes;

    public function mount(): void
    {
        $this->fieldTypes = collect(FieldTypes::cases());
    }

    public function showModalEdit($field_id): void
    {
        $this->fieldEdit = $this->form->fields()->find($field_id);
        $this->field['name'] = $this->fieldEdit->description;
        $this->field['type'] = $this->fieldEdit->type;
        $this->field['required'] = (bool)$this->fieldEdit->required;
        if ($this->fieldEdit->type == 6) {
            $this->field['answers'] = $this->fieldEdit->answers()->orderBy('id', 'ASC')
                ->pluck('description', 'id')->toArray();
        }
        $this->dispatch('toast-notify',
            type: 'info',
            message: 'Editando el campo '.$this->fieldEdit->description
        );
    }

    public function clearField($type): void
    {
        if ($type == 1) {
            $this->fieldEdit = null;
            $this->field = [];
        } else {
            $this->answerEdit = null;
            $this->field_answer = null;
        }
    }

    public function editAnswer($key): void
    {
        $this->field_answer = $this->field['answers'][$key];
        $this->answerEdit = $key;
        $this->dispatch('toast-notify',
            type: 'info',
            message: 'Editando la respuesta: '.$this->field_answer
        );
    }

    public function saveAnswer(): void
    {
        $this->validate([
            'field_answer' => 'required'
        ]);
        if (!in_array($this->field_answer,  $this->field['answers'] ?? [])) {
            $this->field['answers'][$this->field_answer] = $this->field_answer;
            $this->field_answer = null;
            $this->dispatch('toast-notify',
                type: 'success',
                message: 'Respuesta agregada correctamente'
            );
        } else {
            $this->dispatch('toast-notify',
                type: 'error',
                message: 'Ya existe esta respuesta'
            );
        }
    }
    public function updateAnswer(): void
    {
        $this->field['answers'][$this->answerEdit] = $this->field_answer;
        $this->answerEdit = null;
    }

    public function changeForm($form_name, $description): void
    {
        $this->fieldEdit = null;
        $this->field = [];
        $this->answerEdit = null;
        $this->field_answer = null;
        $bool_action = $this->$form_name;
        $this->form_socio_economic_study = false;
        $this->form_initial_data = false;
        $this->$form_name = $bool_action;

        if ($this->form_initial_data || $this->form_socio_economic_study) {
            $this->alert = $description;
            $id_form = $this->form_initial_data ? 1 : 2;
            $this->form = Form::find($id_form);
        } else {
            $this->form = null;
            $this->alert = null;
        }
    }

    public function saveField(): void
    {
        $field_data = $this->fieldGeneralData();
        $field = $this->form->fields()->create([
            'description' => $field_data['name'],
            'type' => $field_data['type'],
            'required' => $field_data['required']
        ]);
        if ($this->field['type'] == 6) {
            foreach ($field_data['answers'] as $answer) {
                $field->answers()->create([
                    'description' => $answer
                ]);
            }
        }
        $this->field = [];
        $this->dispatch('toast-notify',
            type: 'success',
            message: 'Se ha guardado el campo'
        );
    }

    public function updateField(): void
    {
        $field_data = $this->fieldGeneralData();
        $this->fieldEdit->update([
            'description' => $field_data['name'],
            'type' => $field_data['type'],
            'required' => $field_data['required']
        ]);
        if ($this->field['type'] == 6) {
            $field_answers = $this->fieldEdit->answers;
            foreach ($field_answers as $answer) {
                if (key_exists($answer->id, $this->field['answers'])) {
                    $answer->update([
                        'description' => $this->field['answers'][$answer->id]
                    ]);
                } else {
                    $answer->delete();
                }
            }
            foreach ($this->field['answers'] as $key => $answer_name) {
                if (is_string($key)) {
                    $this->fieldEdit->answers()->create([
                        'description' => $answer_name
                    ]);
                }
            }
        }
    }

    public function deleteAnswer($key_answer): void
    {
        unset($this->field['answers'][$key_answer]);
        $this->dispatch('toast-notify',
            type: 'info',
            message: 'Respuesta eliminada'
        );
    }

    public function fieldGeneralData(): array
    {
        $fields_validate = [
            'field.name' => ['required', 'string'],
            'field.type' => ['required', 'integer'],
            'field.required' => ['required', 'bool'],
        ];
        if (($this->field['type'] ?? null) == 6) {
            $fields_validate['field.answers'] = ['required', 'array'];
        }
        $this->validate($fields_validate);
        $field_data = $this->field;
        $id_form = $this->form_initial_data ? 1 : 2;
        $this->form = Form::find($id_form);
        return $field_data;
    }

    public function render(): View
    {
        return view('livewire.app.forms.settings');
    }
}
