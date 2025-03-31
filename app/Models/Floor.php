<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{

    protected $fillable = ['building_id', 'floor_number'];

    public function building() {
        return $this->belongsTo(Building::class);
    }

    public function units() {
        return $this->hasMany(Unit::class);
    }
}
