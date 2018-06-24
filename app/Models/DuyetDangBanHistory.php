<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DuyetDangBanHistory extends Model
{
    protected $table = "duyetdangbanhistory";

    protected $fillable = [
        'dangban_id', 'comment','status', 'ischeck', 'isfix'];

    function DangBan(){
        return $this->belongsTo('App\Models\DangBan', 'dangban_id');
    }
    
    
}
