<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietKhuyenMai extends Model
{
    protected $table = "chitietkhuyenmai";

    function LoaiKhuyenMai(){
        return $this->belongsTo('App\Models\LoaiKhuyenMai', 'loaikhuyenmai_id');
    }

    function SanPham(){
        return $this->belongsTo('App\Models\SanPham', 'sanpham_id');
    }
}
