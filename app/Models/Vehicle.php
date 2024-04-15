<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'color',
        'brand',
        'vehicle_type',
        'driver_id',
        'owner_id',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
