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

Route::get('/admin/login','userController@getLogin')->name('admin.login');
Route::post('/admin/login','userController@postLogin')->name('admin.login');

Route::group(['prefix'=>'admin','middleware'=>'adminMiddleware'],function(){
    Route::get('/', 'adminController@index')->name('admin.index');
    Route::get('/logout','userController@logout')->name('admin.logout');
    // Route::get('/danhthu/index', 'admin_controller@danhthu')->name('admin.danhthu');
    // Route::get('/donhang', 'donhang_controller@index')->name('donhang.index');
    // Route::get('/donhang/show/{id}', 'donhang_controller@show')->name('donhang.show');
    // Route::get('/donhang/destroy/{id}', 'donhang_controller@destroy')->name('donhang.destroy');
    // Route::get('/donhang/nhandon/{id}', 'donhang_controller@nhandon')->name('donhang.nhandon');
    // Route::get('/donhang/tinhtrang/{id}/{tt}', 'donhang_controller@tinhtrang')->name('donhang.tinhtrang');

    // Route::post('/sanpham/nhap-excel','sanpham_controller@postnhap')->name('excel.nhap');
    // Route::get('/sanpham/xuat-excel','sanpham_controller@getxuat')->name('excel.xuat');
    // Route::get('/sanpham/delete/{id}','sanpham_controller@delete')->name('sanpham.delete');

    Route::resources([
        'danhmuc'=>'danhmucController',
        
        'nhanhieu'=>'nhanhieuController',
        'xuatxu'=>'xuatxuController',
        'sanpham'=>'sanphamController',
        'baohanh'=>'baohanhController',
       
        'user'=>'userController',
       
        
    ]);
});