<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietMuaDaiLy extends Model
{
    protected $table = "chitietmuadaily";
    protected $primaryKey = "chitiethoadon_id";
    public $incrementing = 'false';

    function DaiLy(){
        return $this->belongsTo('App\Models\DaiLy', 'daily_id', 'thanhvien_id');
    }

    function ChiTietHoaDon(){
        return $this->belongsTo('App\Models\ChiTietHoaDon');
    }
}
