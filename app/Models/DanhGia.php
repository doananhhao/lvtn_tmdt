<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = "danhgia";
    protected $primaryKey = ['thanhvien_id', 'sanpham_id'];
    public $incrementing = false;

    function ThanhVien(){
        return $this->belongsTo('App\Models\ThanhVien', 'thanhvien_id');
    }
    
    function SanPham(){
        return $this->belongsTo('App\Models\SanPham', 'sanpham_id');
    }

    public static function find($primaryOne, $PrimaryTwo) {
        return DanhGia::where('thanhvien_id', '=', $primaryOne)
            ->where('sanpham_id', '=', $PrimaryTwo)
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
}
