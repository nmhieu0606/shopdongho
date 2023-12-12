@extends('layouts/site')
@section('main')
<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

            <form action="{{ route('home.postRegister') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="hovaten">Họ và tên <span class="text-danger font-weight-bold">*</label>
                    <input type="text" class="form-control" id="hovaten" name="hovaten">
                    {{ $errors->first('hovaten') }}
                </div>

                <div class="mb-3">
                    <label for="privilege">Giới tính <span class="text-danger font-weight-bold">*</span></label>
                    <select class="custom-select form-control @error('privilege') is-invalid @enderror" id="gioitinh"
                        name="gioitinh">
                        <option value="" selected="selected">-- Choose --</option>
                        <option value="0">Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                    {{ $errors->first('gioitinh') }}
                </div>

                <div class="mb-3">
                    <label for="ngaysinh" class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="ngaysinh" name="ngaysinh">
                    {{ $errors->first('ngaysinh') }}
                </div>

                <div class="mb-3">
                    <label for="diachi">Địa chỉ <span class="text-danger font-weight-bold">*</span></label>
                    <input type="text" class="form-control" id="diachi" name="diachi">
                    {{ $errors->first('diachi') }}
                </div>
                <div class="mb-3">
                    <label for="sdt">SĐT <span class="text-danger font-weight-bold">*</span></label>
                    <input type="text" class="form-control" id="sdt" name="sdt">
                    {{ $errors->first('sdt') }}
                </div>
				


                <div class="mb-3">
                    <label for="email">Email <span class="text-danger font-weight-bold">*</span></label>
                    <input type="text" class="form-control" id="email" name="email">
                    {{ $errors->first('email') }}
                </div>
                <div class="mb-3">
                    <label for="tendangnhap">Tên đăng nhập <span class="text-danger font-weight-bold">*</span></label>
                    <input type="text" class="form-control" id="tendangnhap" name="tendangnhap">
                    {{ $errors->first('tendangnhap') }}
                </div>
                <div class="mb-3">
                    <label for="password">Mật khẩu <span class="text-danger font-weight-bold">*</span></label>
                    <input type="text" class="form-control" id="password" name="password">
                    {{ $errors->first('password') }}
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
          
        </div>
      </div>
    </div>
   
  </section>
@endsection