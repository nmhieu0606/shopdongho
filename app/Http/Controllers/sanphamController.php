<?php

namespace App\Http\Controllers;

use App\Models\sanpham;
use Illuminate\Http\Request;
use App\Models\nhanhieu;
use App\Models\xuatxu;
use App\Models\baohanh;
use App\Models\danhmuc;
use App\Imports\sanpham_import;
use App\Exports\sanpham_export;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use File;
use Excel;

class sanphamController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=sanpham::search()->paginate(10);
        
        return view('admin.sanpham.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhanhieu=nhanhieu::all();
        $xuatxu=xuatxu::all();
        $baohanh=baohanh::all();
        $danhmuc=danhmuc::all();
        return view('admin.sanpham.create',compact('nhanhieu','xuatxu','baohanh','danhmuc'));
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
            'tensp.required' => 'Tên sản phẩm không được bỏ trống',
            'soluong.required' => 'Số lượng không được bỏ trống',
            'gianhap.required' => 'Giá nhập không được bỏ trống',
            'giaxuat.required' => 'Giá xuất không được bỏ trống',
            'nhanhieu_id.required' => 'Nhãn hiệu không được bỏ trống',
            'xuatxu_id.required' => 'Xuất xứ không được bỏ trống',
            'baohanh_id.required' => 'Bảo hành không được bỏ trống',
            'danhmuc_id.required' => 'Danh mục không được bỏ trống',

        ];
        $request->validate([
            'tensp'=>'required|max:100',
            'soluong'=>'required|numeric',
            'gianhap'=>'required|numeric',
            'giaxuat'=>'required|numeric',
            'nhanhieu_id'=>'required',
            'xuatxu_id'=>'required',
            'baohanh_id'=>'required',
            'danhmuc_id'=>'required',
            'chitiet'=>'required'

        ],$messages);
        if($request->has('file_uploads')){
            $file=$request->file_uploads;
            $ex=$request->file_uploads->extension();
            $file_name=time().''.$request->tensp.''.'.'.$ex;
            $file->move(public_path('uploads'),$file_name);
          
        }
        $sanpham=[
            'tensp'=>$request->tensp,
            'anh'=>$file_name,
            'soluong'=>$request->soluong,
            'gianhap'=>$request->gianhap,
            'giaxuat'=>$request->giaxuat,
            'sale'=>$request->sale,
            'giasale'=>$request->sale?((100-$request->sale)/100)*$request->giaxuat:$request->giaxuat,
            'nhanhieu_id'=>$request->nhanhieu_id,
            'xuatxu_id'=>$request->xuatxu_id,
            'baohanh_id'=>$request->baohanh_id,
            'danhmuc_id'=>$request->danhmuc_id,
            'chitiet'=>$request->chitiet,

        ];
        //$request->merge(['anh'=>$file_name]);
        if(sanpham::create($sanpham)){
            return redirect('admin/sanpham');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show(sanpham $sanpham)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nhanhieu=nhanhieu::all();
        $xuatxu=xuatxu::all();
        $baohanh=baohanh::all();
        $danhmuc=danhmuc::all();
        $data=sanpham::find($id);
        return view('admin.sanpham.edit',compact('data','nhanhieu','xuatxu','baohanh','danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tensp'=>'required|max:100',
            'soluong'=>'required|numeric',
            'gianhap'=>'required|numeric',
            'giaxuat'=>'required|numeric',
            'nhanhieu_id'=>'required',
            'xuatxu_id'=>'required',
            'baohanh_id'=>'required',
            'danhmuc_id'=>'required',
            'chitiet'=>'required',

        ]);

        if($request->has('file_uploads')){
            $file=$request->file_uploads;
            $ex=$request->file_uploads->extension();
            $file_name=time().''.$request->tensp.''.'.'.$ex;
            $file->move(public_path('uploads'),$file_name);

            $data=sanpham::find($id);
            File::delete('public/uploads/'.$data->anh);
            $request->merge(['anh'=>$file_name]);
        }
        $anhcu=sanpham::find($id);
        $sanpham=[
            'tensp'=>$request->tensp,
            'anh'=>$request->has('file_uploads')?$file_name:$anhcu->anh,
            'soluong'=>$request->soluong,
            'gianhap'=>$request->gianhap,
            'giaxuat'=>$request->giaxuat,
            'sale'=>$request->sale,
            'giasale'=>$request->sale?((100-$request->sale)/100)*$request->giaxuat:$request->giaxuat,
            'nhanhieu_id'=>$request->nhanhieu_id,
            'xuatxu_id'=>$request->xuatxu_id,
            'baohanh_id'=>$request->baohanh_id,
            'danhmuc_id'=>$request->danhmuc_id,
            'chitiet'=>$request->chitiet,
        ];
        if(sanpham::find($id)->update($sanpham)){
            return redirect('admin/sanpham');
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $data= dathang_chitiet::find($id);
    //    if($data->dathang_chitiet->count()==0){
    //        $data->delete();
    //        return redirect()->back()->with('yes', 'Xóa thành công');
    //    }
    //    else{
         
    //     return redirect()->back()->with('no', 'Xóa không thành công');
    //    }
    // }
    public function postnhap(Request $request){
        Excel::import(new sanpham_import,$request->file('file'));
        return redirect('admin/sanpham');
    }
    public function getxuat(){
        return Excel::download(new sanpham_export,'danh-sach-san-pham.xlsx');
    }
    public function delete($id){
        
       
        if( sanpham::find($id)->dathang_chitiet->count()){
            return redirect()->route('sanpham.index')->with('no','không thể xóa sản phẩm vì sản phẩm có trong đơn hàng');
        }
        else{
            $data=sanpham::find($id);
            $duongdan = 'public/uploads';
            File::delete($duongdan.'/'.$data->anh);
            $data->delete();
            return redirect()->route('sanpham.index')->with('yes','Xóa sản phẩm thành công');
        }
    }
}
