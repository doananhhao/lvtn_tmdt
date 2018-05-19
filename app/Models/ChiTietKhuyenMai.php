<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietKhuyenMai extends Model
{
    protected $table = "chitietkhuyenmai";

    function LoaiKhuyenMai(){
        return $this->belongsTo('App\Models\LoaiKhuyenMai');
    }

    function SanPham(){
        return $this->belongsTo('App\Models\SanPham');
    }
}
