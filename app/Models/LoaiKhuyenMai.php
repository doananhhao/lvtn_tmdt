<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiKhuyenMai extends Model
{
    protected $table = "loaikhuyenmai";

    function ChiTietHoaDon(){
        return $this->hasMany('App\Models\ChiTietHoaDon');
    }

    function ChiTietKhuyenMai(){
        return $this->hasMany('App\Models\ChiTietKhuyenMai', 'loaikhuyenmai_id');
    }
}
