<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scotter extends Model
{
    protected $guarded=[];
    public function trips()
    {
        return $this->hasMany('App\Models\Trip', 'scotter_id');
    }

}
