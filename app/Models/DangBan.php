<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DangBan extends Model
{
    protected $table = "dangban";

    function ThanhVien(){
        return $this->belongsTo('App\Models\ThanhVien', 'thanhvien_id');
    }
    
    function SanPham(){
        return $this->belongsTo('App\Models\SanPham', 'sanpham_id');
    }
}
