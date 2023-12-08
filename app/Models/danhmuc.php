<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhmuc extends Model
{
    use HasFactory;
    protected $table = 'danhmuc';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function sanpham(){
        return $this->hasMany(sanpham::class,'danhmuc_id','id');
    }
    public function scopeSearch($query){
        if($tukhoa=request()->tukhoa){
          $query=$query->where('tendanhmuc','like','%'.$tukhoa.'%');
        }
        return $query;
  
    }
}
