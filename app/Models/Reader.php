<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_meter',
        'battery_level',
        'load_level',
        'active',
        'load_date'
    ];
    public function meters()
    {
        return $this->belongsTo(Meter::class);
    }
}
