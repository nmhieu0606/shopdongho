@extends('layouts.admin')
@section('main')
<p>index baohanh</p>

<a href="{{route('baohanh.create')}}" type="button" class="btn btn-primary">Thêm</a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Thời gian bảo hành</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
       {{-- <?php $c=1; ?> --}}
    @foreach ($data as $c =>$item)
       
        <tr>
            <th scope="row">{{$c}}</th>
            <td>{{$item->thoigianbaohanh}}</td>
            <td><a href="{{route('baohanh.edit',$item->id)}}" class="btn btn-danger black">Sửa</a></td>
            <td><a href="{{route('baohanh.destroy',$item->id)}}" class="btn btn-yellow black btn-delete">Xóa</a></td>
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