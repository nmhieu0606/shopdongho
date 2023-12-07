@extends('layouts.admin')
@section('main')
<form action="" class="form-inline">
  <div class="form-group ">
    <input class="form-control" name="tukhoa" placeholder="Nhập tên sản phẩm">
   </div>
  <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
</form>
<a href="{{route('sanpham.create')}}"  class="btn btn-primary mt-1">Thêm</a> 
{{-- <a href="{{route('excel.xuat')}}"  class="btn btn-warning mt-1">Xuất ra excel</a>  --}}
<button type="button" class="btn btn-success mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Nhập từ excel
</button>
<div class="card" >
 
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th width="5%" scope="col">ID</th>
            <th width="20%" scope="col">Tên sản phẩm</th>
            <th width="5%" scope="col">Ảnh</th>
            <th width="10%" scope="col">giá nhập</th>
            <th width="10%" scope="col">giá xuất</th>
            <th width="10%" scope="col">Số lượng</th>
            <th width="15%" scope="col">Nhãn hiệu</th>
            <th width="10%" scope="col">Xuất xứ</th>
            <th width="10%" scope="col">Bảo hành</th>
            <th width="10%" scope="col">Danh mục</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->tensp}}</td>
            <td >
              <img src="{{url('public/uploads')}}/{{$item->anh}}" width="30px">
            </td>
            <td>{{$item->gianhap}}</td>
            <td>{{$item->giaxuat}}</td>
            <td>{{$item->soluong}}</td>
            <td>{{$item->nhanhieu->nhanhieu}}</td>
            <td>{{$item->xuatxu->xuatxu}}</td>
            <td>{{$item->baohanh->thoigianbaohanh}}</td>
            <td>{{$item->danhmuc->tendanhmuc}}</td>
           
            <td>
                <a href="{{route('sanpham.edit',$item->id)}}" class="btn btn-danger">Sửa</a> 
            </td>
            <td>
              <a onclick="return confirm('Bạn có muốn xóa sản phẩm {{$item->tensp}}')" href="{{route('sanpham.destroy',$item->id)}}" class="btn btn-warning btndelete">Xóa</a>
           </td>
         
            </tr>
          @endforeach
        </tbody>
      </table>
      
     
       
    </div>
</div>
<hr>
<!-- Button trigger modal -->


<!-- Modal -->

  {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('excel.nhap')}}" method="POST" enctype="multipart/form-data">
      @csrf 
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label for="file">Chọn tập tin excel</label>
            <br>
            <input name="file" type="file">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Nhập</button>
          </div>
        </div>
      </div>
    </form>
  </div> --}}

<div class="">{{$data->appends(request()->all())->links()}}</div>



@endsection




