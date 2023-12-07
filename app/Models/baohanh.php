<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baohanh extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='baohanh';
    //protected $filltable=['id','tendanhmuc'];
    public function sanpham(){
      return $this->hasMany(sanpham::class,'baohanh_id','id');
    }

    public function scopeSearch($query){
        if($tukhoa=request()->tukhoa){
          $query=$query->where('thoigianbaohanh','like','%'.$tukhoa.'%');
        }
        return $query;
  
    }
}
