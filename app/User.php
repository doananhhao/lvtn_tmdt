<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'loaiuser_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function LoaiUser(){
        return $this->belongsTo('App\Models\LoaiUser', 'loaiuser_id', 'id');
    }

    function ThanhVien(){
        return $this->hasOne('App\Models\ThanhVien');
    }

    function BinhLuan(){
        return $this->hasMany('App\Models\BinhLuan');
    }

    function HoaDon(){
        return $this->hasMany('App\Models\HoaDon');
    }
}
