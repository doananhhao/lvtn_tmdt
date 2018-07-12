<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanCong extends Model
{
    protected $table = "phancong";

    protected $fillable = [
        'hoadon_id', 'nhanvien_id', 'congdoan_id', 'comments'
    ];

    function HoaDon(){
        return $this->belongsTo('App\Models\HoaDon', 'hoadon_id');
    }
    function NhanVien(){
        return $this->belongsTo('App\Models\NhanVien', 'nhanvien_id', 'nhanvien_id');
    }
    function CongDoan(){
        return $this->belongsTo('App\Models\CongDoan', 'congdoan_id');
    }
    function scopeHoadon($query, $idhd)
    {
        return $query->where('hoadon_id', $idhd);
    }
}
