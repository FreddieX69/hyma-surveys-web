<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FieldAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'field_id'
    ];

    public function field(): HasOne
    {
        return $this->hasOne(Field::class, 'id', 'field_id');
    }
}
