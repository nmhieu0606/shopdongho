<?php

namespace App\Http\Controllers;

use App\Models\xuatxu;
use Illuminate\Http\Request;

class xuatxuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=xuatxu::search()->paginate(10);
        return view('admin.xuatxu.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.xuatxu.create');
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
            'xuatxu.required' => 'Tên xuất xứ không được bỏ trống',
        ];

        $request->validate([
            'xuatxu'=>'required|max:100|unique:xuatxu',
        ],$messages);
        $data=new xuatxu;
        $data->xuatxu=$request->xuatxu;
        if($data->save()){
            return redirect('admin/xuatxu');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\xuatxu  $xuatxu
     * @return \Illuminate\Http\Response
     */
    public function show(xuatxu $xuatxu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\xuatxu  $xuatxu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=xuatxu::find($id);
        return view('admin.xuatxu.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\xuatxu  $xuatxu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $messages = [
            'xuatxu.required' => 'Tên xuất xứ không được bỏ trống',
            'xuatxu.unique' => 'Tên xuất xứ đã tồn tại',
        ];

        $request->validate([
            'xuatxu'=>'required|max:100|unique:xuatxu,xuatxu,'.$id,
        ],$messages);

        $data=xuatxu::find($id);
        $data->xuatxu=$request->xuatxu;
        if($data->save()){
            return redirect('admin/xuatxu');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\xuatxu  $xuatxu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=xuatxu::find($id);
        if($data->sanpham->count()==0){
            $data->delete();
            return redirect()->back()->with('yes', 'Xóa thành công');
        }
        else{
            return redirect()->back()->with('no', 'Xóa không thành công');
        }
    }
}
