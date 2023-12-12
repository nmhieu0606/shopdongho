<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\cart;
use App\Models\sanpham;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\dathang;
use App\Models\dathangChitiet;
use Carbon\Carbon;
use App\Models\user;
class homeController extends Controller
{
    public function index(){
        return view('index');
    }
    public function addToCart(cart $cart,$id){
       
        $sp=sanpham::find($id);
        $cart->add($sp);
       
        return redirect()->back()->with('yes','Thêm vào giỏ thành công');

    }
    public function getCart(){
        return view('cart');
    }
    public function up(cart $cart,$id){
       
      
        $cart->up($id);
       
        return redirect()->back()->with('yes','Tăng số lượng thành công');

    }

    public function down(cart $cart,$id){
       
       
        $cart->down($id);
       
        return redirect()->back()->with('yes','GIẢM số lượng thành công');

    }
    public function delete(cart $cart,$id){
       
       
        $cart->delete($id);
       
        return redirect()->back()->with('yes','Xóa sản phẩm khỏi giỏ hàng thành công');

    }


    public function getLogin(){
        return view('login');
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
                
                return redirect('/');
            }
            else{
                
                return redirect('/login');
            }

        }
       
        
       

        
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function kiemtra(cart $cart){
        $tam=false;
        foreach($cart->items as $sanpham_id=>$item){
            $sp=sanpham::find($sanpham_id);
            if($item['soluong']<=$sp->soluong){
                return $tam=true;
            }
            else
                return $tam=false;
        }
        return $tam;
    }
    

    public function getCheckout(cart $cart){
        if($cart->items!=null){

            if($this->kiemtra($cart)){
                return view('checkout');
            }
            else{      
                $error='';
                foreach($cart->items as $sanpham_id=>$item){
                    $sp=sanpham::find($sanpham_id);
                    if($item['soluong']>$sp->soluong){
                        $error.=' |Số lượng sản phẩm "'.$sp->tensp.'" chỉ còn '.$sp->soluong.' trong kho ';
                    }
                }

              
                return redirect()->back()->with('no',$error);

            } 

        }
        else{
            return redirect()->back()->with('no','Đơn hàng trống');
        }
       
    }

    public function pay(cart $cart){
        $id=Auth::user()->id;
        $dathang=new dathang;
        $dathang->user_id=$id;
        $dathang->ngaydathang=Carbon::now();
        $dathang->tongtien=$cart->getGia();
        if($dathang->save()){
            foreach($cart->items as $sanpham_id=>$item){
                $gia=$item['gia'];
                $soluong=$item['soluong'];
                $dathang_chitiet=new dathangChitiet;
                $dathang_chitiet->dathang_id=$dathang->id;
                $dathang_chitiet->sanpham_id=$sanpham_id;
                $sp=sanpham::find($sanpham_id);
                if($sp->soluong>=$soluong){
                    $sp->soluong-=$soluong;
                    $sp->save();
                    $dathang_chitiet->soluong=$soluong;
                    $dathang_chitiet->dongia=$gia*$soluong;
                    $dathang_chitiet->save();
                }
                else{
                    $xoadathang=dathang::find($dathang->id);
                    $xoadathang->delete();
                    return redirect('/cart')->with('no','số lượng sản phẩm: '.$sp->tensp.' số lượng chỉ còn '.$sp->soluong.'');
                }
            }
           
        

            session()->forget('cart');
            return view('thankyou');
        } 

        
    }
    public function history(){
        $data=dathang::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('history',compact('data'));
    }
    public function dhct($id){
        $data=dathangChitiet::where('dathang_id',$id)->orderBy('dathang_id','DESC')->get();
        return view('historyDetail',compact('data'));
    }
    public function search(sanpham $sanpham){
        $data= $sanpham::search()->get();
        return response()->json($data);
       
    }
    public function detail(sanpham $sanpham,$id){
        $data= $sanpham::where('id',$id)->first();
        return view('detail',compact('data'));
       
    }
    public function danhmuc(sanpham $sanpham,$id){
        $data= $sanpham::where('danhmuc_id',$id)->get();
        if($data->count()>0){
            return view('danhmuc',compact('data'));

        }
        else{

            return view('danhmuc',compact('data'))->with('no','Danh muc khong co san pham');
        }
       
        
       
       
    }
    public function nhanhieu(sanpham $sanpham,$id){
        $data= $sanpham::where('nhanhieu_id',$id)->get();
        if($data->count()>0){
            return view('danhmuc',compact('data'));

        }
        else{

            return view('danhmuc',compact('data'))->with('no','Nhãn hiệu khong co san pham');
        }
       
        
       
       
    }
    public function getRegister(){
        return view('register');
    }
    public function postRegister(Request $request){
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
        
       if($data->save()) {
           return redirect('/login')->with('yes','Đăng ký tài khoản thành công');
       }
    }
    public function getInfor(){
        $data=Auth::user();
        return view('infor',compact('data'));


    }
    public function postInfor(Request $request){
        
        $user=Auth::user()->id;
        //dd($user);

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
           
            'tendangnhap'=>'required|max:100|unique:user,tendangnhap,'.$user,
            
            'email'=>'required|email|max:100|unique:user,email,'.$user,
        ],$messages);
        $data=User::find($user);
        //dd($data);
        $data->hovaten=$request->hovaten;
        $data->gioitinh=$request->gioitinh;
        $data->ngaysinh=$request->ngaysinh;
        $data->diachi=$request->diachi;
        $data->sdt=$request->sdt;
        $data->tendangnhap=$request->tendangnhap;
        $data->email=$request->email;
        if(!empty($request->password)) 
        $data->password =Hash::make($request->password);
        if($data->save()) {
            return redirect('/infor')->with('yes','Cập nhật thông tin thành công');
        }


        return  redirect()->back()->with('no','Cập nhật không thành công');


    }

}
