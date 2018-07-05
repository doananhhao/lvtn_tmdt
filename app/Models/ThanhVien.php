<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThanhVien extends Model
{
    protected $table = "thanhvien";
    protected $primaryKey = "user_id";
    public $incrementing = 'false';

    protected $fillable = ['capdo_id'];
    
    function User(){
        return $this->belongsTo('App\User');
    }

    function DanhGia(){
        return $this->hasMany('App\Models\DanhGia', 'thanhvien_id', 'user_id');
    }

    function DangBan(){
        return $this->hasMany('App\Models\DangBan', 'thanhvien_id', 'user_id');
    }

    function DaiLy(){
        return $this->hasOne('App\Models\DaiLy', 'thanhvien_id', 'user_id');
    }

    function CapDo(){
        return $this->belongsTo('App\Models\CapDo', 'capdo_id', 'id');
    }
}
