<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CongDoanHoaDon extends Model
{
    protected $table = 'congdoanhoadon';

    protected $fillable = ['hoadon_id', 'congdoan_id', 'truongphong_id', 'status'];

    function HoaDon(){
        return $this->belongsTo('App\Models\HoaDon', 'hoadon_id');
    }
    
    function CongDoan(){
        return $this->belongsTo('App\Models\CongDoan', 'congdoan_id');
    }
    
    function TruongPhong(){
        return $this->belongsTo('App\Models\NhanVien', 'truongphong_id', 'nhanvien_id');
    }
}
