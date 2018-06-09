<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    protected $table = "chucvu";

    protected $fillable = ['ten'];

    function NhanVien(){
        return $this->hasMany('App\Models\NhanVien', 'chucvu_id');
    }
}
