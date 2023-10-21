<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientForm extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'patient_forms';
    protected $fillable = [
        'patient_id',
        'status',
        'patient_id',
        'form_id',
        'user_id',
        'social_worker_id',
    ];

    public function formResponses(): HasMany
    {
        return $this->hasMany(PatientResponse::class, 'patient_form_id', 'id');
    }

    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    public function form(): HasOne
    {
        return $this->hasOne(Form::class, 'id', 'form_id');
    }
}
