<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaiLy extends Model
{
    protected $table = "daily";
    protected $primaryKey = "thanhvien_id";
    public $incrementing = 'false';

    function ThanhVien(){
        return $this->belongsTo('App\Models\ThanhVien', 'thanhvien_id', 'user_id');
    }

    function ChiTietMuaDaiLy(){
        return $this->hasMany('App\Models\ChiTietMuaDaiLy', 'daily_id', 'thanhvien_id');
    }
}
