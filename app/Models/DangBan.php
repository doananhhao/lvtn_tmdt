<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DangBan extends Model
{
    protected $table = "dangban";

    protected $fillable = ['thanhvien_id', 'sanpham_id', 'mota', 'ngayhethan', 'canduyet'];

    function ThanhVien(){
        return $this->belongsTo('App\Models\ThanhVien', 'thanhvien_id');
    }
    
    function SanPham(){
        return $this->belongsTo('App\Models\SanPham', 'sanpham_id');
    }

    function DuyetDangBanHistory(){
        return $this->hasMany('App\Models\DuyetDangBanHistory', 'dangban_id');
    }
}
