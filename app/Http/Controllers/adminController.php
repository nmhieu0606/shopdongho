<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dathang;
use App\Models\User;
use App\Models\sanpham;
class adminController extends Controller
{
    public function index(){

        $dathang=dathang::all()->count();
        $user=user::all()->count();
        $sp1=sanpham::all()->count();
        //dd($sp);
        return view('admin.index',compact(['dathang','user','sp1']));
    }
    public function getLogin(){
        return view('admin.login');
    }

}
