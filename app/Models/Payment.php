<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
       protected $guarded=[];
         public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
}
