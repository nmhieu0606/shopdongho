@extends('layouts.admin')
@section('main')

<form method="POST" action="{{route('baohanh.update',$data->id)}}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Thời gian bảo hành</label>
      <input value="{{$data->thoigianbaohanh}}" name="thoigianbaohanh" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
  </form>


  <script>



  </script>
@endsection