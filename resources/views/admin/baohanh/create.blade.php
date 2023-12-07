@extends('layouts.admin')
@section('main')

<form method="POST" action="{{route('baohanh.store')}}">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Thời gian bảo hành</label>
      <input name="thoigianbaohanh" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection