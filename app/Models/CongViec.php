<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CongViec extends Model
{
    protected $table = "congviec";

    protected $fillable = [
        'tenviec'
    ];

    function PhanCong(){
        return $this->hasMany('App\Models\PhanCong', 'congviec_id');
    }
}
