<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhaCungCap extends Model
{
    protected $table = "nhacungcap";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ten', 'diachi', 'sdt'
    ];


    function SanPham(){
        return $this->hasMany('App\Models\SanPham', 'nhacungcap_id');
    }
}
