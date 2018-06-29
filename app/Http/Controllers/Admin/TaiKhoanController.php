<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaiKhoanController extends Controller
{
    private $data = [];

    function __construct(){
        $this->data['title'] = "Thông tin tài khoản";
        $this->data['title2'] = 'Thông tin tài khoản';
    }

    function index(){
        $this->data['user'] = Auth::User();
        return view('admin.tttk.index', $this->data);
    }
}
