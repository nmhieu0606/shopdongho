@extends('layouts.site')
@section('main')
    
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Ngày đặt hàng</th>
        <th scope="col">Tình trạng</th>
        <th scope="col">Tổng tiền</th>
        <th scope="col">#</th>

      </tr>
    </thead>
    <tbody class="table-group-divider table-divider-color">
        @foreach ($data as $id=>$item)
            <tr>
                <th scope="row">{{$id}}</th>
                <td>{{$item->ngaydathang}}</td>
                @if ($item->tinhtrang==0)
                    <td>Đơn hàng đang chuẩn bị</td>
                @elseif ($item->tinhtrang==1)
                    <td>Giao hàng thành công</td>
                @elseif ($item->tinhtrang==3)
                <td>Giao hàng không thành công</td>
                @endif
                <td>{{number_format($item->tongtien)}} VND</td>
                <td><a href="{{route('home.dhct',$item->id)}}" class="btn btn-primary">Xem</a></td>
          </tr>
            
        @endforeach
      
      
    </tbody>
  </table>
@endsection