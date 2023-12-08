@extends('layouts.admin')
@section('main')
<p>index nhanhieu</p>

@if(Session::has('yes'))
   <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('yes') }}</p>
  @endif
  @if(Session::has('no'))
   <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('no') }}</p>
  @endif
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
  $('.btn-delete').click(function(e){
    e.preventDefault();
    alert('asdsa');

  })
</script>
@endsection