<?php
namespace App\Helper;

class Cart{
    public $items=[];
    public $soluong=0;
    public $gia=0;
    public function __construct(){
        $this->items=session('cart')?session('cart'):[];
        $this->soluong=$this->getSoluong();
        $this->gia=$this->getGia();
    }

    public function add($sanpham,$soluong=1){
        $item=[
            'id'=>$sanpham->id,
            'tensp'=>$sanpham->tensp,
            'gia'=>$sanpham->giaxuat,
            'anh'=>$sanpham->anh,
            'soluong'=>1,
        ];
        if(isset($this->items[$sanpham->id])){
            
            $this->items[$sanpham->id]['soluong']+=1;
           
        }
        else{
           
            $this->items[$sanpham->id]=$item; 

        }
        session(['cart'=>$this->items]);
        
    }

    public function delete($id){
        if(isset($this->items[$id])){
            unset($this->items[$id]);
        }
        session(['cart'=>$this->items]);

    }

    public function update($id,$soluong){
     
        if($this->items[$id]){
            $this->items[$id]['soluong']=$soluong;
        }
        session(['cart'=>$this->items]);

    }
    public function up($id){
     
        if(isset($this->items[$id])){
            $this->items[$id]['soluong']+=1;
        }
        session(['cart'=>$this->items]);

    }
    public function down($id){
     
        if(isset($this->items[$id])){
            $this->items[$id]['soluong']-=1;
            if($this->items[$id]['soluong']==0){
                unset($this->items[$id]);
            }
        }
        session(['cart'=>$this->items]);

    }
    public function deleteAll(){
        session()->forget('cart');
    }
    public function getGia(){
        $t=0;
        foreach($this->items as $it){
            $t+=$it['gia']*$it['soluong'];
        }
        return $t;
    }
    private function getSoluong(){
        $t=0;
        foreach($this->items as $it){
            $t+=$it['soluong'];
        }
        return $t;
    }




}











?>