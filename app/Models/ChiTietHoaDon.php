<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    protected $table = "chitiethoadon";

    protected $fillable = ['hoadon_id', 'sanpham_id', 'loaikhuyenmai_id', 'soluong', 'gia'];

    function HoaDon(){
        return $this->belongsTo('App\Models\HoaDon', 'hoadon_id');
    }

    function ChiTietMuaDaiLy(){
        return $this->hasMany('App\Models\ChiTietMuaDaiLy', 'chitiethoadon_id');
    }

    function SanPham(){
        return $this->belongsTo('App\Models\SanPham', 'sanpham_id');
    }

    function LoaiKhuyenMai(){
        return $this->belongsTo('App\Models\LoaiKhuyenMai', 'loaikhuyenmai_id');
    }
}
