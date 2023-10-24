<?php

namespace App\Livewire\App\Dashboard;

use App\Models\Field;
use App\Models\Form;
use App\Models\Patient;
use App\Models\PatientForm;
use App\Models\PatientResponse;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public $patients, $socialEconomicStudies, $forms, $form_id, $fields = [], $field_selected, $begin_date, $end_date,
        $labels = [], $values = [], $charts_title, $field_id;
    public Form $form;


    public function mount(): void
    {
        $this->patients = Patient::all();
        $this->socialEconomicStudies = PatientForm::whereRelation('form', 'id', 4)->get();
        $this->forms = Form::all();
        $this->form_id = 4;
        $this->form = $this->forms->find($this->form_id);
        $this->fields = $this->form->fields()->whereIn('type', [5,6])->get();
        $this->fillCharts($this->fields->first() ?? null);
        $this->dispatch('toast-notify',
            type: 'success',
            message: 'Datos cargados correctamente'
        );
    }

    public function updateFields(): void
    {
        $this->form = $this->forms->find($this->form_id);
        $this->fields = $this->form->fields()->whereIn('type', [5,6])->get();
        $this->fillCharts($this->fields->first() ?? null);
    }

    public function fillCharts($field): void
    {
        $this->charts_title = null;
        if ($field ?? null) {
            $this->field_selected = $this->fields->find($field);
        } else {
            $this->validate([
                'field_id' => ['required', 'integer']
            ]);
            $this->field_selected = $this->fields->find($this->field_id);
        }
        $this->charts_title = $this->field_selected->description ?? null;
        $this->labels = [];
        $this->values = [];
        $responses = collect(PatientResponse::whereRelation('field','form_id', $this->form->id)
            ->where('field_id', $this->field_selected->id ?? null)->get());
        if ($this->field_selected) {
            if ($this->field_selected->type == 6) {
                $answers =  $this->field_selected->answers()->orderBy('id')->get();
                foreach ($answers as $answer) {
                    $this->labels[] = $answer->description;
                    $this->values[] = $responses->where('field_answer_id', $answer->id)->count();
                }
            } else {
                $this->labels = ['Sí', 'No'];
                $this->values[] = $responses->where('answer', 1)->count();
                $this->values[] = $responses->where('answer', 0)->count();
            }
        }
        $this->dispatch('update-charts', values: json_encode($this->values), labels: json_encode($this->labels));
    }

    public function changeField()
    {
                $this->dispatch('update-charts', values: json_encode($this->values), labels: json_encode($this->labels));
    }
    public function render(): View
    {
        return view('livewire.app.dashboard.dashboard');
    }
}
