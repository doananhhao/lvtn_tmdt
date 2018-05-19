<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = "sanpham";

    function NhaCungCap(){
        return $this->belongsTo('App\Models\NhaCungCap');
    }
    
    function LoaiSP(){
        return $this->belongsTo('App\Models\LoaiSP');
    }

    function ChiTietKhuyenMai(){
        return $this->hasMany('App\Models\ChiTietKhuyenMai');
    }

    function ChiTietHoaDon(){
        return $this->hasMany('App\Models\ChiTietHoaDon');
    }

    function DangBan(){
        return $this->hasMany('App\Models\DangBan');
    }

    function DanhGia(){
        return $this->hasMany('App\Models\DanhGia');
    }

    function BinhLuan(){
        return $this->hasMany('App\Models\BinhLuan');
    }
}
