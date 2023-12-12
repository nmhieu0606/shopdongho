<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dathang;
use App\Models\dathangChitiet;
class dathangController extends Controller
{
    public function index()
    {
        $data=dathang::search()->paginate(10);
        return view('admin.dathang.index',compact('data'));

    }
    public function dhct($id){

      
        $data=dathangChitiet::where('dathang_id',$id)->orderBy('dathang_id','DESC')->get();
        //dd($data);
        return view('admin.dathang.detail',compact('data'));
    }

    public function update($id,$tt){

     
        $data=dathang::find($id)->first();
        
        $data->tinhtrang=$tt;
        $data->save();
        return redirect()->back()->with('yes','Cập nhật tình trạng đơn hàng thành công');
    }
    public function destroy($id){
        $data=dathangChitiet::where('dathang_id',$id)->delete();
    
        dathang::find($id)->delete();
        return redirect()->back()->with('yes','Xóa thành công');
    }
}
