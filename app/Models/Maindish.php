<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maindish extends Model
{
    use HasFactory;

    protected $fillable = ['code','name','price','menut_id','description'];

    function menut() {
        return $this->belongsTo(menut::class);
    }
}
