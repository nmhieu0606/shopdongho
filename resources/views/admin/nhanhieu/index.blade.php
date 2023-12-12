@extends('layouts.admin')
@section('main')
<p>index nhanhieu</p>


  <form action="" method="GET" class="form-inline">
    <div class="form-group ">
      <input class="form-control" name="tukhoa" placeholder="Nhập tên danh mục">
     </div>
    <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
  </form>
<a href="{{route('nhanhieu.create')}}" type="button" class="btn btn-primary">Thêm</a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">slug</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
       {{-- <?php $c=1; ?> --}}
    @foreach ($data as $c =>$item)
       
        <tr>
            <th scope="row">{{$c}}</th>
            <td>{{$item->nhanhieu}}</td>
            <td>{{$item->slug}}</td>
            <td><a href="{{route('nhanhieu.edit',$item->id)}}" class="btn btn-danger black">Sửa</a></td>
            <td><a href="{{route('nhanhieu.destroy',$item->id)}}" class="btn btn-yellow black btn-delete">Xóa</a></td>
        </tr>
        
        
    @endforeach
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