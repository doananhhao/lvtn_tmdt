<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiSP extends Model
{
    protected $table = "loaisp";

    protected $fillable = [
        'tenloai', 'classfaicon'
    ];

    function SanPham(){
        return $this->hasMany('App\Models\SanPham', 'loaisp_id');
    }
}
