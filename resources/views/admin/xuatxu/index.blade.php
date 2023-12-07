@extends('layouts.admin')
@section('main')
<p>index xuatxu</p>

<a href="{{route('xuatxu.create')}}" type="button" class="btn btn-primary">Thêm</a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Xuất xứ</th>
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
            <td>{{$item->xuatxu}}</td>
         
            <td><a href="{{route('xuatxu.edit',$item->id)}}" class="btn btn-danger black">Sửa</a></td>
            <td><a href="{{route('xuatxu.destroy',$item->id)}}" class="btn btn-yellow black btn-delete">Xóa</a></td>
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