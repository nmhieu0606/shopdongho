@extends('layouts.site')
@section('main')
    
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Đơn giá</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Thành tiền</th>
        <th scope="col">#</th>

      </tr>
    </thead>
    <tbody class="table-group-divider table-divider-color">
        @foreach ($data as $id=>$item)
            <tr>
                <td>{{$id}}</td>
                <td>{{$item->sanpham->tensp}}</td>
                <td>{{$item->dongia}}</td>
                <td>{{$item->soluong}}</td>
                <td>{{$item->dongia*$item->soluong}}</td>
               
            </tr>
            
        @endforeach
      
      
    </tbody>
  </table>
@endsection