<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhanhieu extends Model
{
    use HasFactory;
    
    protected $table='nhanhieu';
    public $timestamps = false;
    public function scopeSearch($query){
        if($tukhoa=request()->tukhoa){
          $query=$query->where('nhanhieu','like','%'.$tukhoa.'%');
        }
        return $query;
  
    }

    public function sanpham(){
        return $this->hasMany(sanpham::class,'nhanhieu_id','id');
    }
}
