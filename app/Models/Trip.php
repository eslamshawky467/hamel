<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $guarded=[];
    public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function scotter()
    {
        return $this->belongsTo('App\Models\Scotter', 'scotter_id');
    }
}
