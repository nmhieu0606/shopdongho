@extends('layouts.admin')
@section('main')
<div class="card" >
    <div class="card-body">
        <form action="{{route('sanpham.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tensp" class="form-label">Nhập tên sản phẩm</label>
                <input type="text" class="form-control" @error('tensp') is-invalid @enderror name="tensp" id="tensp"  >
                {{$errors->first('tensp')}}
              </div>
           

            <div class="form-group">
                <label for="anh">Hình ảnh sản phẩm <span class="text-danger font-weight-bold">*</span></label>
                <input id="file_uploads" type="file" class="form-control @error('anh') is-invalid @enderror" name="file_uploads" value="{{ old('file_uploads') }}"  />
                {{$errors->first('anh')}}
                    
               
            </div>

            <div class="form-group">
                <label for="soluong">Số lượng <span class="text-danger font-weight-bold">*</span></label>
                <input id="soluong" type="number" min="0" class="form-control @error('soluong') is-invalid @enderror" name="soluong" />
                {{$errors->first('soluong')}}
            </div>
            <div class="form-group">
                <label for="gianhap">Giá nhập <span class="text-danger font-weight-bold">*</span></label>
                <input id="gianhap" type="number" min="0" class="form-control @error('gianhap') is-invalid @enderror" name="gianhap" value="{{ old('gianhap') }}"  />
                {{$errors->first('gianhap')}}
            </div>

            <div class="form-group">
                <label for="giaxuat">Gía xuất <span class="text-danger font-weight-bold">*</span></label>
                <input id="giaxuat" type="number" min="0" class="form-control @error('giaxuat') is-invalid @enderror" name="giaxuat" value="{{ old('giaxuat') }}"  />
                {{$errors->first('giaxuat')}}
            </div>
            <div class="form-group">
                <label for="sale">Sale % <span class="text-danger font-weight-bold">*</span></label>
                <input id="sale" type="number" min="0" class="form-control @error('sale') is-invalid @enderror" name="sale" value="{{ old('sale') }}"  />
                {{$errors->first('giaxuat')}}
            </div>

            <div class="form-group">
                <label for="nhanhieu_id"><span class="text-danger font-weight-bold">*</span></label>
                <select id="nhanhieu_id" class="form-control custom-select @error('nhanhieu_id') is-invalid @enderror" name="nhanhieu_id" >
                    <option value="">-- Chọn loại nhãn hiệu --</option>
                    @foreach($nhanhieu as $value)
                        <option value="{{ $value->id }}">{{ $value->nhanhieu }}</option>
                    @endforeach
                </select>
                {{$errors->first('nhanhieu_id')}}
            </div>

            <div class="form-group">
                <label for="xuatxu_id"><span class="text-danger font-weight-bold">*</span></label>
                <select id="xuatxu_id" class="form-control custom-select @error('xuatxu_id') is-invalid @enderror" name="xuatxu_id" >
                    <option value="">-- Chọn xuất xứ --</option>
                    @foreach($xuatxu as $value)
                        <option value="{{ $value->id }}">{{ $value->xuatxu}}</option>
                    @endforeach
                </select>
                {{$errors->first('xuatxu_id')}}
            </div>
            <div class="form-group">
                <label for="baohanh_id"><span class="text-danger font-weight-bold">*</span></label>
                <select id="baohanh_id" class="form-control custom-select @error('baohanh_id') is-invalid @enderror" name="baohanh_id" >
                    <option value="">--Chọn thời gian bảo hành--</option>
                    @foreach($baohanh as $value)
                        <option value="{{ $value->id }}">{{ $value->thoigianbaohanh}}</option>
                    @endforeach
                </select>
                {{$errors->first('baohanh_id')}}
            </div>
            <div class="form-group">
                <label for="danhmuc_id"><span class="text-danger font-weight-bold">*</span></label>
                <select id="danhmuc_id" class="form-control custom-select @error('danhmuc_id') is-invalid @enderror" name="danhmuc_id" >
                    <option value="">--Chọn danh mục sản phẩm--</option>
                    <?php showdanhmuc($danhmuc)?>
                </select>
                {{$errors->first('danhmuc_id')}}
            </div>


            <div class="form-group">
                <label for="chitiet" class="form-label">Chi tiết</label>
                <textarea class="form-control ckeditor" name="chitiet" id="chitiet" cols="10" rows="1"></textarea>
                <div class="invalid-feedback"></div>
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>

@endsection
