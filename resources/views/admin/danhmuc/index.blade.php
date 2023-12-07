@extends('layouts.admin')
@section('main')
<p>index danhmuc</p>

<a href="{{route('danhmuc.create')}}" type="button" class="btn btn-primary">Thêm</a>

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
            <td>{{$item->tendanhmuc}}</td>
            <td>{{$item->slug}}</td>
            <td><a href="{{route('danhmuc.edit',$item->id)}}" class="btn btn-danger black">Sửa</a></td>
            <td><a href="{{route('danhmuc.destroy',$item->id)}}" class="btn btn-yellow black btn-delete">Xóa</a></td>
        </tr>
        
        
    @endforeach
     
      
    </tbody>
  </table>
@endsection

@section('js')

<script>
  $('.btn-delete').click(function(e){
    e.preventDefault();
    alert('asdsa');

  })
</script>
@endsection