<?php

namespace App\Livewire\App\Dashboard;

use App\Models\Field;
use App\Models\Form;
use App\Models\Patient;
use App\Models\PatientForm;
use App\Models\PatientResponse;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public $patients, $socialEconomicStudies, $forms, $form_id, $fields = [], $field_selected, $begin_date, $end_date,
        $labels = [], $values = [], $charts_title, $field_id;
    public Form $form;


    public function mount(): void
    {
        $this->authorize('Dashboard');
        $this->patients = Patient::all();
        $this->socialEconomicStudies = PatientForm::whereRelation('form', 'id', 4)->get();
        $this->forms = Form::all();
        $this->form_id = 4;
        $this->form = $this->forms->find($this->form_id);
        $this->fields = $this->form->fields()->whereIn('type', [5,6])->get();
        $this->field_id = $this->fields->first()?->id;
        $this->fillCharts();
        $this->dispatch('toast-notify',
            type: 'success',
            message: 'Datos cargados correctamente'
        );
    }

    public function updateFields(): void
    {
        $this->form = $this->forms->find($this->form_id);
        $this->fields = $this->form->fields()->whereIn('type', [5,6])->get();
        $this->field_id = $this->fields->first()?->id;
        $this->fillCharts();
    }

    public function fillCharts(): void
    {
        $this->validate([
            'field_id' => ['required', 'integer']
        ]);
        $this->field_selected = $this->fields->find($this->field_id);
        $this->charts_title = $this->field_selected->description ?? null;
        $this->labels = [];
        $this->values = [];
        $responses = collect(PatientResponse::whereRelation('field','form_id', $this->form->id)
            ->whereHas('patientForm', function ($patientForm) {
                $dates = [
                    $this->begin_date ? Carbon::parse($this->begin_date)->format('Y-m-d 00:00:00') : '2000-01-01 00:00:00',
                    $this->end_date ? Carbon::parse($this->end_date)->format('Y-m-d 23:59:59') : date('Y-m-d H:i:s'),
                ];
                $patientForm->whereBetween('created_at', $dates);
            })
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
