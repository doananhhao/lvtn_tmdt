<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapDo extends Model
{
    protected $table = "capdo";

    protected $fillable = ['capdo', 'diem', 'chietkhau'];

    function ThanhVien(){
        return $this->hasMany('App\Models\ThanhVien', 'capdo_id', 'id');
    }
}
