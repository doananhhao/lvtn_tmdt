<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanCong extends Model
{
    protected $table = "phancong";
    protected $primaryKey = ['congviec_id', 'hoadon_id', 'nhanvien_id'];
    public $incrementing = false;

    protected $fillable = [
        'congviec_id', 'hoadon_id', 'nhanvien_id'
    ];

    public static function find($primaryOne, $primaryTwo, $primaryThree) {
        return DanhGia::where('congviec_id', '=', $primaryOne)
            ->where('hoadon_id', '=', $primaryTwo)
            ->where('nhanvien_id', '=', $primaryThree)
            ->first();
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(\Illuminate\Database\Eloquent\Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    function CongViec(){
        return $this->belongsTo('App\Models\CongViec', 'congviec_id');
    }
    function HoaDon(){
        return $this->belongsTo('App\Models\HoaDon', 'hoadon_id');
    }
    function User(){
        return $this->belongsTo('App\User', 'nhanvien_id');
    }
}
