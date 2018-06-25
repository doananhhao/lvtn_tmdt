<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    protected $table = "phongban";

    protected $fillable = ['ten'];

    function NhanVien(){
        return $this->hasMany('App\Models\NhanVien', 'phongban_id');
    }

    function TruongPhong(){
        return $this->belongsTo('App\Models\NhanVien', 'truongphong_id', 'nhanvien_id');
    }

    function CongDoan(){
        return $this->hasMany('App\Models\CongDoan', 'phongban_id');
    }
}
