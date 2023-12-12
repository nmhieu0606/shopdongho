@extends('layouts.site')
@section('main')

@foreach ($sp as $item)
@if ($item->soluong!=0)
<div class="col-md-3 col-md-4 col-lg-3 mb-5 mb-md-0 rounded">

    <div class="card ">
        <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
          <img src="{{url('public/uploads')}}/{{$item->anh}}" class="img-fluid rounded"/>
          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body">
          <h5 class="card-title text-center">{{$item->tensp}}</h5>

          <div class="row">
            <div class="col-md-6 text-center"> <a href="{{route('home.detail',$item->id)}}" class="btn btn-success" data-mdb-ripple-init>Xem</a></div>
         
         
            <div class="col-md-6 text-center"> <a href="{{route('home.addToCart',$item->id)}}" class="btn btn-primary" data-mdb-ripple-init>Mua</a></div>
        </div>
        </div>
      </div>

     
     
      
   
</div> 

 

    
@endif

    
@endforeach
<div class="">{{ $sp->appends(request()->all())->links() }}</div>
@endsection