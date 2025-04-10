<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = ['unit_id', 'name', 'contact'];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
