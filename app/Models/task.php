<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    function staff(){
        return $this->hasOne(staff::class , 'id', 'user_id');
    }

}
