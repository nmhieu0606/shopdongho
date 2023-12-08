<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dathangChitiet extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='dathang_chitiet';
    protected $fillable=['dathang_id','sanpham_id','soluong','dongia'];
    public function sanpham(){
        return $this->hasOne(sanpham::class,'id','sanpham_id');
    }
    
    public function dathang(){
        return $this->hasOne(dathang::class,'id','dathang_id');
    }

    public function scopeSearch($query){
        if($tukhoa=request()->tukhoa){
          $query=$query->where('dathang_id', 'like','%'.$tukhoa.'%');
        }
        return $query;
  
    }
}
