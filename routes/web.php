<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/','homeController@index')->name('home.index');
Route::get('/addToCart/{id}','homeController@addToCart')->name('home.addToCart');
Route::get('/cart','homeController@getCart')->name('home.getCart');
Route::get('/search','homeController@search')->name('home.search');
Route::get('/search/{id}','homeController@detail')->name('home.detail');
Route::get('/danhmuc/{id}','homeController@danhmuc')->name('home.danhmuc');
Route::get('/nhanhieu/{id}','homeController@nhanhieu')->name('home.nhanhieu');
Route::get('/register','homeController@getRegister')->name('home.getRegister');
Route::post('/register','homeController@postRegister')->name('home.postRegister');

Route::get('/cart/up/{id}','homeController@up')->name('home.up');
Route::get('/cart/down/{id}','homeController@down')->name('home.down');
Route::get('/cart/delete/{id}','homeController@delete')->name('home.delete');

Route::get('/login','homeController@getLogin')->name('home.getLogin');
Route::post('/login','homeController@postLogin')->name('home.login');
Route::get('/logout','homeController@logout')->name('home.logout');

Route::get('/admin/login','userController@getLogin')->name('admin.login');
Route::post('/admin/login','userController@postLogin')->name('admin.login');
Route::get('/admin/logout','userController@logout')->name('admin.logout');
Route::group(['prefix'=>'admin','middleware'=>'adminMiddleware'],function(){
    Route::get('/', 'adminController@index')->name('admin.index');
   
    // Route::get('/danhthu/index', 'admin_controller@danhthu')->name('admin.danhthu');
    // Route::get('/donhang', 'donhang_controller@index')->name('donhang.index');
    // Route::get('/donhang/show/{id}', 'donhang_controller@show')->name('donhang.show');
    // Route::get('/donhang/destroy/{id}', 'donhang_controller@destroy')->name('donhang.destroy');
    // Route::get('/donhang/nhandon/{id}', 'donhang_controller@nhandon')->name('donhang.nhandon');
    // Route::get('/donhang/tinhtrang/{id}/{tt}', 'donhang_controller@tinhtrang')->name('donhang.tinhtrang');

    // Route::post('/sanpham/nhap-excel','sanpham_controller@postnhap')->name('excel.nhap');
    // Route::get('/sanpham/xuat-excel','sanpham_controller@getxuat')->name('excel.xuat');
    Route::get('/sanpham/delete/{id}','sanphamController@delete')->name('sanpham.delete');
    Route::get('/dathang/{id}','dathangController@dhct')->name('admin.dhct');
    Route::get('/dathang/update/{id}/{tt}','dathangController@update')->name('admin.dh.update');

    Route::resources([
        'danhmuc'=>'danhmucController',
        
        'nhanhieu'=>'nhanhieuController',
        'xuatxu'=>'xuatxuController',
        'sanpham'=>'sanphamController',
        'baohanh'=>'baohanhController',
        'dathang'=>'dathangController',
       
        'user'=>'userController',
       
        
    ]);
});

Route::group(['middleware'=>'guestMiddleware'],function(){
    Route::get('/infor', 'HomeController@getInfor')->name('home.infor');
    Route::post('/infor', 'HomeController@postInfor')->name('home.infor');
    Route::get('/checkout', 'HomeController@getCheckout')->name('home.checkout');
    Route::get('/pay', 'HomeController@pay')->name('home.pay');
    Route::get('/history', 'HomeController@history')->name('home.history');
    Route::get('/history/{id}', 'HomeController@dhct')->name('home.dhct');

    
});