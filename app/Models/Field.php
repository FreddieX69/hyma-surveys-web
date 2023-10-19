<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'type',
        'required',
        'form_id'
    ];

    public function form(): HasOne
    {
        return $this->hasOne(Form::class, 'id', 'form_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(FieldAnswer::class, 'field_id', 'id');
    }
}
