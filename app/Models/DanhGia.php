<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = "thanhvien";
    protected $primaryKey = ['thanhvien_id', 'sanpham_id'];
    public $incrementing = false;

    function ThanhVien(){
        return $this->belongsTo('App\Models\ThanhVien', 'thanhvien_id');
    }
    
    function SanPham(){
        return $this->belongsTo('App\Models\SanPham', 'sanpham_id');
    }
}
