<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CongDoan extends Model
{
    protected $table = 'congdoan';

    protected $fillable = ['FK_congdoantruoc', 'FK_congdoansau', 'phongban_id', 'mota'];

    function CongDoanTruoc(){
        return $this->belongsTo('App\Models\CongDoan', 'FK_congdoantruoc', 'id');
    }

    function CongDoanSau(){
        return $this->belongsTo('App\Models\CongDoan', 'FK_congdoansau', 'id');
    }

    function CongDoanHoaDon(){
        return $this->hasMany('App\Models\CongDoanHoaDon', 'congdoan_id');
    }

    function PhongBan(){
        return $this->belongsTo('App\Models\PhongBan', 'phongban_id');
    }
}
