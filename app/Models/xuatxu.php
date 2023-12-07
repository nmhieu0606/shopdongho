<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xuatxu extends Model
{
    use HasFactory;
    protected $table='xuatxu';
    public $timestamps = false;
    public function sanpham(){
        return $this->hasMany(sanpham::class,'xuatxu_id','id');
    }
    public function scopeSearch($query){
        if($tukhoa=request()->tukhoa){
          $query=$query->where('xuatxu','like','%'.$tukhoa.'%');
        }
        return $query;
  
      }
}
