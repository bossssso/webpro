<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menut extends Model
{
    use HasFactory;

    protected $fillable = ['code','name','description'];

    function maindishes() {
        return $this->hasMany(maindish::class);
    }
}
