<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'identification_number',
        'first_name',
        'second_name',
        'last_name',
        'address',
        'phone',
        'city',
    ];
    public function setSecondNameAttribute($value)
    {
        $this->attributes['second_name'] = $value ?: null;
    }
}
