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

    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || 
                    abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || 
                abort(401, 'This action is unauthorized.');
    }

    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
        return null !== $this->LoaiUser()->whereIn('tenloai', $roles)->first();
    }

    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->LoaiUser()->where('tenloai', $role)->first();
    }

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

    function PhanCong(){
        return $this->hasMany('App\Models\PhanCong', 'nhanvien_id');
    }
}
