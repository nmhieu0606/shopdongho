@extends('layouts.admin')
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
                @elseif ($item->tinhtrang==2)
                <td>Đơn hàng đã hủy</td>
                @endif
                <td>{{number_format($item->tongtien)}} VND</td>
                <td><a href="{{route('admin.dhct',$item->id)}}" class="btn btn-primary">Xem</a></td>
                <td><a href="{{route('dathang.destroy',$item->id)}}" class="btn btn-danger btn-delete">Xóa</a></td>
                <td>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Cập nhật đơn hàng
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      
                        <a href="{{route('admin.dh.update',['id'=>$item->id,'tt'=>0])}}" class="dropdown-item" >Đang chuẩn bị</a>
                        <a href="{{route('admin.dh.update',['id'=>$item->id,'tt'=>1])}}" class="dropdown-item" >Giao thành công</a>
                        <a href="{{route('admin.dh.update',['id'=>$item->id,'tt'=>2])}}" class="dropdown-item" >Hủy đơn hàng</a>
                    </div>
                  </div>
                </td>
          </tr>
            
        @endforeach
      
      
    </tbody>
  </table>

  <form method="POST" action="" id="form-delete">
    @csrf @method('DELETE')
  <form>
  </tbody>
</table>
<div class="">{{ $data->appends(request()->all())->links() }}</div>
@endsection
@section('js')

<script>
  $('.btn-delete').click(function(ev){
    ev.preventDefault();
    var _href=$(this).attr('href');
    $('form#form-delete').attr('action',_href);
    if(confirm('bạn có chắc muốn xóa nó không?')){
        $('form#form-delete').submit();
    }
    
  })
</script>
@endsection