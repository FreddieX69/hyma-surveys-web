<?php

namespace App\Livewire\App\Forms;

use App\Exports\FormExport;
use App\Models\Form;
use App\Models\PatientResponse;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PatientForm;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FormTable extends DataTableComponent
{
    public $form_id, $fields;
    public ?Form $form;
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFilterLayoutSlideDown();
        $this->setFilterSlideDownDefaultStatusEnabled();
        $this->setBulkActions([
            'exportSelected' => 'Exportar a Excel',
        ]);
    }

    public function mount($form_id): void
    {
        $this->form_id = $form_id;
        $this->form = Form::find($this->form_id);
        $this->fields = $this->form->fields()->get();
    }
    public function builder(): Builder
    {
        return PatientForm::query()->whereRelation('form', 'id', $this->form_id);
    }
    public function exportSelected(): BinaryFileResponse
    {
        $headers = $this->form->fields()->orderBy('id')->pluck('description', 'id')->toArray();
        $content = $this->getSelected();
        return Excel::download(new FormExport($headers, $content), $this->form->description.'.xlsx');
    }

    public function columns(): array
    {
        $columns = [
            Column::make('Nombre', 'patient.name')->sortable(),
            Column::make('Correo Electrónico', 'patient.email')->sortable(),
            Column::make('Tipo de paciente', 'patient.type')->format(function ($type) {
                return $type == 1 ? 'Adulto' : 'Niño';
            })
        ];
        foreach ($this->form->fields()->orderBy('id')->get() as $field) {
            if (in_array($field->type, [0,1,2,3])) {
                $columns[] = Column::make($field->description, 'id')
                    ->format(function ($id) use ($field) {
                        $answer = PatientResponse::where('patient_form_id', $id)->where('field_id', $field->id)->first();
                        return $answer->answer ?? null;
                    })->sortable();
            } elseif ($field->type == 4) {
                $columns[] = Column::make($field->description, 'id')
                    ->format(function ($id) use ($field) {
                        $answer = PatientResponse::where('patient_form_id', $id)->where('field_id', $field->id)->first();
                        if ($answer) {
                            $url = $answer->answer;
                            return view('components.image-button', compact('url'));
                        } else {
                            return '';
                        }
                    })->sortable();
            } elseif ($field->type == 5) {
                $columns[] = Column::make($field->description, 'id')
                    ->format(function ($id) use ($field) {
                        $answer = PatientResponse::where('patient_form_id', $id)->where('field_id', $field->id)->first();
                        if ($answer) {
                            $text = $answer->answer == 1 ? 'Sí' : 'No';
                        } else {
                            $text = '';
                        }
                        return $text;
                    });
            } else {
                $columns[] = Column::make($field->description, 'id')
                    ->format(function ($id) use ($field) {
                        $answer = PatientResponse::where('patient_form_id', $id)->where('field_id', $field->id)->first();
                        if ($answer) {
                            $text = $answer->field_answer->description ?? '';
                        } else {
                            $text = '';
                        }
                        return $text;
                    })->sortable();
            }
        }
        return $columns;
    }

    public function filters(): array
    {
        // TODO: Búsqueda general
        $columns = [
            TextFilter::make('Buscar')
                ->config([
                    'placeholder' => 'Clic fuera para buscar',
                    'maxlength' => '50',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->whereHas('formResponses', function ($formResponses) use ($value) {
                        $formResponses->search($value);
                    })->orWhereHas('patient', function ($patient) use ($value) {
                        $patient->search($value);
                    });
                })
        ];
        if ($this->form->id == 4) {
            $columns[] = SelectFilter::make('Tipo de paciente')
                ->options([
                    '' => 'Todo',
                    '1' => 'Adulto',
                    '2' => 'Niño',
                ])
                ->filter(function (Builder $builder, $value) {
                    $builder->whereHas('patient', function ($patient) use ($value) {
                        $patient->where('type',$value);
                    });
                });
        }
        $collect_fields = collect($this->fields);
        $fields = $collect_fields->whereNotIn('type', [0,1,2,4]);
        foreach ($fields as $field) {
            if ($field->type == 3) {
                // TODO: Campos de tipo fecha
                $columns[] =  DateFilter::make($field->description . ' - Inicio')
                    ->config([
                        'min' => '2010-01-01',
                        'max' => date('Y-m-d'),
                        'pillFormat' => 'd M Y',
                    ])
                    ->filter(function (Builder $builder, $date) use ($field) {
                        $builder->whereHas('formResponses', function ($formResponses) use ($date, $field) {
                            $formResponses->where('field_id', $field->id)->whereDate('answer', '>=', $date);
                        });
                    });
                $columns[] =  DateFilter::make($field->description . ' - Fin')
                    ->config([
                        'min' => '2010-01-01',
                        'max' => date('Y-m-d'),
                        'pillFormat' => 'd M Y',
                    ])
                    ->filter(function (Builder $builder, $date)  use ($field) {
                        $builder->whereHas('formResponses', function ($formResponses) use ($date, $field) {
                            $formResponses->where('field_id', $field->id)->whereDate('answer', '<=', $date);
                        });
                    });
            } elseif ($field->type == 5) {
                // TODO: Campos booleanos (Sí, No)
                $columns[] =  SelectFilter::make($field->description)
                    ->options([
                        '' => 'Todo',
                        '1' => 'Sí',
                        '0' => 'No',
                    ])
                    ->filter(function (Builder $builder, $value)  use ($field) {
                        $builder->whereHas('formResponses', function ($formResponses) use ($value, $field) {
                            $formResponses->where('field_id', $field->id)->where('answer', $value);
                        });
                    });
            } else {
                // TODO: Campos con respuesta seleccionable
                $answers = $field->answers()->pluck('description', 'id')->toArray();
                $columns[] =  SelectFilter::make($field->description)
                    ->options(['' => 'Todo'] + $answers)
                    ->filter(function (Builder $builder, $value)  use ($field) {
                        $builder->whereHas('formResponses', function ($formResponses) use ($value, $field) {
                            $formResponses->where('field_id', $field->id)->where('field_answer_id', $value);
                        });
                    });
            }
        }
        return $columns;
    }
}
