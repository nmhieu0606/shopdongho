@extends('layouts.admin')
@section('main')
<div class="card" >
    <div class="card-body">
        <form action="{{route('sanpham.update',$data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
              <label for="tensp" class="form-label">Nhập tên sản phẩm</label>
              <input type="text" value="{{$data->tensp}}" class="form-control" name="tensp" id="tensp" >
              <a class="text-danger">  {{$errors->first('tensp')}}</a>
            </div>

            <div class="form-group">
                <label for="hinhanh">Hình ảnh sản phẩm <span class="text-danger font-weight-bold">*</span></label>
                <img class="d-block" src="{{url('public/uploads')}}/{{$data->anh}}"  width="30px"/>
                <input id="file_uploads" type="file" class="form-control @error('file_uploads') is-invalid @enderror" name="file_uploads" value="{{ $data->anh }}" autocomplete="hinhanh" />
                @error('hinhanh')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label for="soluong">Số lượng <span class="text-danger font-weight-bold">*</span></label>
                <input id="soluong" value="{{$data->soluong}}" type="number" min="0" class="form-control @error('soluong') is-invalid @enderror" name="soluong" />
                <a class="text-danger">  {{$errors->first('soluong')}}</a>
            </div>
            <div class="form-group">
                <label for="gianhap">Giá nhập <span class="text-danger font-weight-bold">*</span></label>
                <input id="gianhap" value="{{$data->gianhap}}" type="number" min="0" class="form-control @error('gianhap') is-invalid @enderror" name="gianhap" value="{{ old('gianhap') }}"  autocomplete="gianhap" />
                <a class="text-danger">  {{$errors->first('gianhap')}}</a>
            </div>

            <div class="form-group">
                <label for="giaxuat">Gía xuất <span class="text-danger font-weight-bold">*</span></label>
                <input id="giaxuat" value="{{$data->giaxuat}}" type="number" min="0" class="form-control @error('gianhap') is-invalid @enderror" name="giaxuat" value="{{ old('giaxuat') }}"  autocomplete="giaxuat" />
                <a class="text-danger">  {{$errors->first('giaxuat')}}</a>
            </div>

            <div class="form-group">
                <label for="sale">Sale % <span class="text-danger font-weight-bold">*</span></label>
                <input id="sale" type="number" value="{{$data->sale}}" min="0" class="form-control @error('sale') is-invalid @enderror" name="sale" value="{{ old('sale') }}"  />
                {{$errors->first('sale')}}
            </div>

            <div class="form-group">
                <label for="nhanhieu_id"><span class="text-danger font-weight-bold">*</span></label>
                <select id="nhanhieu_id" class="form-control custom-select @error('nhanhieu_id') is-invalid @enderror" name="nhanhieu_id" required autofocus>
                    <option value="">-- Chọn loại nhãn hiệu --</option>
                    @foreach($nhanhieu as $value)
                        <option value="{{ $value->id }}"{{($data->nhanhieu_id== $value->id)?'selected':'' }}>{{$value->nhanhieu}}</option>
                    @endforeach
                </select>
                @error('nhanhieu_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label for="xuatxu_id"><span class="text-danger font-weight-bold">*</span></label>
                <select id="xuatxu_id" class="form-control custom-select @error('xuatxu_id') is-invalid @enderror" name="xuatxu_id" required autofocus>
                    <option value="">-- Chọn xuất xứ --</option>
                    @foreach($xuatxu as $value)
                    <option value="{{ $value->id }}" {{($data->xuatxu_id==$value->id)?'selected':'' }}>{{$value->xuatxu}}</option>
                    @endforeach
                </select>
                @error('xuatxu_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="form-group">
                <label for="baohanh_id"><span class="text-danger font-weight-bold">*</span></label>
                <select id="baohanh_id" class="form-control custom-select @error('baohanh_id') is-invalid @enderror" name="baohanh_id" required autofocus>
                    <option value="">--Chọn thời gian bảo hành--</option>
                    @foreach($baohanh as $value)
                    <option value="{{ $value->id }}" {{($data->baohanh_id== $value->id)?'selected':'' }}>{{$value->thoigianbaohanh}}</option>
                    @endforeach
                </select>
                @error('baohanh_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="form-group">
                <label for="danhmuc_id"><span class="text-danger font-weight-bold">*</span></label>
                <select id="danhmuc_id" class="form-control custom-select @error('danhmuc_id') is-invalid @enderror" name="danhmuc_id" required autofocus>
                    <option value="">--Chọn danh mục sản phẩm--</option>
                    @foreach($danhmuc as $value)
                    <option value="{{ $value->id }}" {{($data->danhmuc_id== $value->id)?'selected':'' }}>{{$value->tendanhmuc}}</option>
                    @endforeach
                </select>
                @error('baohanh_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>


            <div class="form-group">
                <label for="chitiet" class="form-label">Chi tiết</label>
                <textarea  class="form-control ckeditor" name="chitiet" id="chitiet">{{$data->chitiet}}</textarea>
                <div class="invalid-feedback"></div>
                <a class="text-danger">  {{$errors->first('chitiet')}}</a>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>

@endsection
@section('cke')
	<script src="{{ asset('public/js/ckeditor/ckeditor.js') }}"></script>
@endsection