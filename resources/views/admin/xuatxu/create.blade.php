@extends('layouts.admin')
@section('main')

<form method="POST" action="{{route('xuatxu.store')}}">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Xuất xứ</label>
      <input name="xuatxu" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection