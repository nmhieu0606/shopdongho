<?php

namespace App\Http\Controllers;

use App\Models\baohanh;
use Illuminate\Http\Request;

class baohanhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=baohanh::search()->paginate(10);
        return view('admin.baohanh.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.baohanh.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'thoigianbaohanh.required' => 'thời gian bảo hành không được bỏ trống',
            'thoigianbaohanh.unique' => 'thời gian bảo hành đã tồn tại',
        ];

        $request->validate([
            'thoigianbaohanh'=>'required|max:100|unique:baohanh',
        ],$messages);
           
        $data=new baohanh;
        $data->thoigianbaohanh=$request->thoigianbaohanh;
        if($data->save()){
            return redirect('admin/baohanh');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\baohanh  $baohanh
     * @return \Illuminate\Http\Response
     */
    public function show(baohanh $baohanh)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\baohanh  $baohanh
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = baohanh::find($id);
        
		return view('admin.baohanh.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\baohanh  $baohanh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'thoigianbaohanh.required' => 'thời gian bảo hành không được bỏ trống',
        ];

        $request->validate([
            'thoigianbaohanh'=>'required|max:100|unique:baohanh,thoigianbaohanh,'.$id,
        ],$messages);
        $data = baohanh::find($id);
        $data->thoigianbaohanh=$request->thoigianbaohanh;
        if($data->save())
            return redirect('admin/baohanh');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\baohanh  $baohanh
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=baohanh::find($id);
        if($data->sanpham->count()==0){
            $data->delete();
            return redirect()->back()->with('yes','xóa thành công');
    }
    else{
        return redirect()->back()->with('no','xóa không thành công');
    }
    }
}
