<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    protected $table = "binhluan";
    protected $fillable = [
        'user_id', 'sanpham_id', 'noidung'
    ];

    function User(){
        return $this->belongsTo('App\User');
    }
    
    function SanPham(){
        return $this->belongsTo('App\Models\SanPham', 'sanpham_id');
    }
}
