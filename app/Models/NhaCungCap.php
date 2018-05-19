<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhaCungCap extends Model
{
    protected $table = "nhacungcap";

    function SanPham(){
        return $this->hasMany('App\Models\SanPham', 'nhacungcap_id');
    }
}
