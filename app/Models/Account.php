<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table='accounts';
    protected $guarded=[];

    public function file(){
        return $this->morphMany(File::class,'Fileable');
    }
    public function User(){
         return $this->belongsTo('App\Models\Client', 'user_id');
    }
}
