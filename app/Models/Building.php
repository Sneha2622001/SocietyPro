<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{

    protected $fillable = ['name', 'address'];

    public function floors() {
        return $this->hasMany(Floor::class);
    } 
}
