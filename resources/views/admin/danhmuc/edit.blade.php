@extends('layouts.admin')
@section('main')

<form method="POST" action="{{route('nhanhieu.update',$data->id)}}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
      <input value="{{$data->nhanhieu}}" name="tennhanhieu" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
  </form>


  <script>



  </script>
@endsection