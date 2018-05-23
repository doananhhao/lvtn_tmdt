<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = "sanpham";
    
    function NhaCungCap(){
        return $this->belongsTo('App\Models\NhaCungCap', 'nhacungcap_id');
    }
    
    function LoaiSP(){
        return $this->belongsTo('App\Models\LoaiSP', 'loaisp_id');
    }

    function ChiTietKhuyenMai(){
        return $this->hasMany('App\Models\ChiTietKhuyenMai', 'sanpham_id');
    }

    function ChiTietHoaDon(){
        return $this->hasMany('App\Models\ChiTietHoaDon', 'sanpham_id');
    }

    function DangBan(){
        return $this->hasMany('App\Models\DangBan', 'sanpham_id');
    }

    function DanhGia(){
        return $this->hasMany('App\Models\DanhGia', 'sanpham_id');
    }

    function BinhLuan(){
        return $this->hasMany('App\Models\BinhLuan', 'sanpham_id');
    }
}
