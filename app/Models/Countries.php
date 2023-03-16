<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function airport()
    {
        return $this->hasMany(Airports::class);
    }
    public function state()
    {
        return $this->hasMany(State::class);
    }
}
