@extends('layouts.admin')
@section('main')
<p>index xuatxu</p>
@if(Session::has('yes'))
   <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('yes') }}</p>
  @endif
  @if(Session::has('no'))
   <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('no') }}</p>
  @endif
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