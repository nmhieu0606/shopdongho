@extends('layouts.site')
@section('main')

    <div class="row">
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
            <div class="product-image">
                <div class="product_img_box">
                    <img class="w-50" src="{{url('public/uploads')}}/{{$data->anh}}">
                </div>
                
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="pr_detail">
                <div class="product_description">
                    <h4 class="product_title"><a href="">{{$data->tensp}}</a></h4>
                    <div class="product_price">
                     
                    
                        <p>{{number_format($data->giaxuat)}}.VND</p>
                       
                    </div>
                    <br>
    
                    <br>
                   
                  
                    
                    
                </div>
                <hr />
                <div class="cart_extra">
                    <div class="cart_btn">
                        <a href="{{route('home.addToCart',$data->id)}}" class="btn btn-fill-out btn-addtocart btn-themvaogio" type="button"><i class="icon-basket-loaded"></i>Thêm vào giỏ</a>
                        <a class="add_compare" href="#"><i class="icon-shuffle"></i></a>
                        <a class="add_wishlist" href="#"><i class="icon-heart"></i></a>
                    </div>
                </div>
                <hr />
                <ul class="product-meta">
                    
                    <li>Danh mục: <a href="{{route('home.danhmuc',$data->danhmuc_id)}}">{{$data->danhmuc->tendanhmuc}}</a></li>
                    <li>Danh mục: <a href="{{route('home.danhmuc',$data->nhanhieu_id)}}">{{$data->nhanhieu->nhanhieu}}</a></li>
                    
                </ul>
                
               

            </div>

        </div>
        <div  class="pr_desc mt-5">
                    
            {!!$data->chitiet!!}
        </div>
        
    </div>
    

@endsection