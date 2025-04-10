<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'notice_date', 'created_by'];

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
