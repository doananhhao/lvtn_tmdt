<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    protected $table = "nhanvien";

    protected $primaryKey = 'nhanvien_id';
    public $incrementing = false;

    protected $fillable = ['phongban_id', 'chucvu_id', 'luong'];

    function User(){
        return $this->belongsTo('App\User', 'nhanvien_id');
    }

    function PhongBan(){
        return $this->belongsTo('App\Models\PhongBan', 'phongban_id');
    }

    function ChucVu(){
        return $this->belongsTo('App\Models\ChucVu', 'chucvu_id');
    }

    function PhanCong(){
        return $this->hasMany('App\Models\PhanCong', 'nhanvien_id', 'nhanvien_id');
    }

    function CongDoanHoaDon(){
        return $this->hasMany('App\Models\CongDoanHoaDon', 'truongphong_id', 'nhanvien_id');
    }
}
