<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'email',
        'phones',
        'type',
        'initial_data',
        'socio_economic_study',
    ];

    public function forms(): HasOne
    {
        return $this->hasOne(PatientForm::class, 'patient_id', 'id');
    }
}
