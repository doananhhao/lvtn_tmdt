<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = "hoadon";

    protected $fillable = ['user_id', 'diachi', 'sdt', 'mota'];
    
    function User(){
        return $this->belongsTo('App\User');
    }

    function ChiTietHoaDon(){
        return $this->hasMany('App\Models\ChiTietHoaDon', 'hoadon_id');
    }

    function PhanCong(){
        return $this->hasMany('App\Models\PhanCong', 'hoadon_id');
    }

    function CongDoanHoaDon(){
        return $this->hasMany('App\Models\CongDoanHoaDon', 'hoadon_id');
    }
}
