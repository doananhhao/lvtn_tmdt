<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = "hoadon";

    function User(){
        return $this->belongsTo('App\User');
    }

    function ChiTietHoaDon(){
        return $this->hasMany('App\Models\ChiTietHoaDon');
    }
}
