<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientResponse extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'patient_form_id',
        'field_id',
        'answer',
        'field_answer_id',
    ];

    protected $searchableFields = ['*'];

    public function patientForm(): HasOne
    {
        return $this->hasOne(PatientForm::class, 'id', 'patient_form_id');
    }

    public function field(): HasOne
    {
        return $this->hasOne(Field::class, 'id', 'field_id');
    }

    public function field_answer(): HasOne
    {
        return $this->hasOne(FieldAnswer::class, 'id', 'field_answer_id');
    }
}
