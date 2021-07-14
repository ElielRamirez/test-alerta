<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    use HasFactory;
    protected $fillable = [
            'num_meter',
            'description',
            'version',
            'type', //MNI, MNA, MNT
            'instalation_date'
    ];
    public function readers()
    {
        return $this->belongsToMany(Reader::class);
    }
}
