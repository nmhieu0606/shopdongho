<?php

namespace App\Http\Controllers;

use App\Models\danhmuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class danhmucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd('asdasd');
        $data=danhmuc::search()->paginate(10);
        return view('admin.danhmuc.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd('asdasd');
        return view('admin.danhmuc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $messages = [
            'tendanhmuc.required' => 'Tên chức vụ không được bỏ trống',
            
        ];

        $request->validate([
			'tendanhmuc' => 'required|string|max:100',
			
			
		],$messages);

        $data=new danhmuc;
        $data->tendanhmuc=$request->tendanhmuc;
        $data->slug=Str::slug($request->tendanhmuc);

        
        if($data->save()){
            return redirect('/admin/danhmuc');

        }
        
        

    }

    /**
     * Display the specified resource.
     */
    public function show(danhmuc $danhmuc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=danhmuc::find($id);
        return view('admin.danhmuc.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
       // dd($id);
        $messages = [
            'tendanhmuc.required' => 'Tên danh mục không được bỏ trống',
            'tendanhmuc.unique' => 'Tên danh mục đã tồn tại',

            
        ];

        $request->validate([
			'tendanhmuc' => 'required|unique:danhmuc,tendanhmuc,'.$id
			
			
		],$messages);
        
        $data = danhmuc::find($id);
        $data->tendanhmuc=$request->tendanhmuc;
        $data->slug=Str::slug($request->tendanhmuc);
        
        if($data->save()){
            return redirect('/admin/danhmuc');

        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=danhmuc::find($id);
        if($data->sanpham->count()==0){
            $data->delete();
            return redirect()->back()->with('yes','xóa thành công');
        }
        else{
            return redirect()->back()->with('no','xóa không thành công');
        }
    }
}
