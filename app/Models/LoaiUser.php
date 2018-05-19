<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiUser extends Model
{
    protected $table = "loaiuser";

    function User(){
        return $this->hasMany('App\User', 'loaiuser_id', 'id');
    }
}
