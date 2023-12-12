<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=User::search()->paginate(10);
        return view('admin.user.index',compact('data'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.user.create');  
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
            'hovaten.required' => 'Họ và tên không được bỏ trống',
            'gioitinh.required' => 'Giới tính không được bỏ trống',
            'ngaysinh.required' => 'Ngày sinh không được bỏ trống',
            'diachi.required' => 'Địa chỉ không được bỏ trống',
            'sdt.required' => 'Số điện thoại không được bỏ trống',
            'tendangnhap.required' => 'Tên đăng nhập không được bỏ trống',
            'password.required' => 'Password không được bỏ trống',
            'email.required' => 'email không được bỏ trống',
        ];

        $request->validate([
            'hovaten'=>'required|max:100',
            'gioitinh'=>'required|numeric',
            'diachi'=>'required|max:100',
            'sdt'=>'required|numeric',
            'tendangnhap'=>'required|max:100|unique:user',
            'password'=>'required|max:100|unique:user',
            'email'=>'required|max:100|unique:user',
        ],$messages);
        $data=new User;
        $data->hovaten=$request->hovaten;
        $data->gioitinh=$request->gioitinh;
        $data->ngaysinh=$request->ngaysinh;
        $data->diachi=$request->diachi;
        $data->sdt=$request->sdt;
        $data->tendangnhap=$request->tendangnhap;
        $data->password=Hash::make($request->password);
        $data->email=$request->email;
        $data->admin=$request->admin;
       if($data->save()) {
           return redirect('admin/user');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=User::find($id);
        return view('admin.user.edit',compact('data'));  
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'hovaten.required' => 'Họ và tên không được bỏ trống',
            'gioitinh.required' => 'Giới tính không được bỏ trống',
            'ngaysinh.required' => 'Ngày sinh không được bỏ trống',
            'diachi.required' => 'Địa chỉ không được bỏ trống',
            'sdt.required' => 'Số điện thoại không được bỏ trống',
            
            'tendangnhap.required' => 'Tên đăng nhập không được bỏ trống',
            'email.required' => 'email không được bỏ trống',
            'email.email' => 'email phải đúng định dạng',
        ];

        $request->validate([
            'hovaten'=>'required|max:100',
            'gioitinh'=>'required|numeric',
            'diachi'=>'required|max:100',
            'sdt'=>'required|numeric',
           
            'tendangnhap'=>'required|max:100|unique:user,tendangnhap,'.$id,
            
            'email'=>'required|email|max:100|unique:user,email,'.$id,
        ],$messages);
        $data=User::find($id);
        $data->hovaten=$request->hovaten;
        $data->gioitinh=$request->gioitinh;
        $data->ngaysinh=$request->ngaysinh;
        $data->diachi=$request->diachi;
        $data->sdt=$request->sdt;
        $data->admin=$request->admin;
      
       
        $data->tendangnhap=$request->tendangnhap;
        $data->email=$request->email;
        if(!empty($request->password)) 
        $data->password =Hash::make($request->password);
        if($data->save()) {
            return redirect('admin/user');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=User::find($id);
        
        if($data->dathang->count()==0||$data->dathang->count()==null){
            $data->delete();
            return redirect()->back()->with('yes','xóa thành công');
        }
        else{
            return redirect()->back()->with('no','xóa không thành công');
        }
    }

    public function getLogin(){
        return view('admin.login');
    }
   
    public function postLogin(Request $request){

       
        $validator=Validator::make($request->all(),[
            'tendangnhap'=>'required|exists:user',
            'password'=>'required',
        ],[
            'tedangnhap.required'=>'Tên đăng nhập không được bỏ trống',
            'tedangnhap.exists'=>'Tên đăng nhập không tồn tại',
            'password'=>'Mật khẩu không được bỏ trống',

        ]);
        if($validator->passes()){
            $arr=[
                'tendangnhap'=>$request->tendangnhap,
                'password'=>$request->password
               
            ];
            
            if($data=Auth::attempt($arr)){
                
                return redirect('admin/');
            }
            else{
                
                return redirect('admin/');
            }

        }
       
        
       

        
    }
    public function logout(){
        Auth::logout();
        return redirect('admin/');
    }
    

    
}
