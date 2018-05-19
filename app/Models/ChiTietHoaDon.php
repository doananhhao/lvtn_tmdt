<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    protected $table = "chitiethoadon";

    function HoaDon(){
        return $this->belongsTo('App\Models\HoaDon');
    }

    function ChiTietMuaDaiLy(){
        return $this->hasMany('App\Models\ChiTietMuaDaiLy');
    }

    function SanPham(){
        return $this->belongsTo('App\Models\SanPham');
    }

    function LoaiKhuyenMai(){
        return $this->belongsTo('App\Models\LoaiKhuyenMai');
    }
}
