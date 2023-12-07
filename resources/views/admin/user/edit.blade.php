@extends('layouts.admin')
@section('main')
    <div class="card-body">
        <form action="{{ route('user.update', $data->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label for="TieuDe" class="form-label">Họ và tên</label>
                <input type="text" value="{{ $data->hovaten }}" class="form-control" id="hovaten" name="hovaten">
                <div class="invalid-feedback">Họ và tên không được bỏ trống.</div>
                {{ $errors->first('hovaten') }}
            </div>

            <div class="mb-3">
                <label for="privilege">giới tính <span class="text-danger font-weight-bold">*</span></label>
                <select class="custom-select form-control" id="gioitinh" name="gioitinh">
                    <option value="">-- Choose --</option>

                    
                    @if ($data->gioitinh==0)
                      <option selected value="0">Nam</option>
                      <option value="1" >Nữ</option>

                    @else
                      <option  value="0">Nam</option>
                      <option selected value="1" >Nữ</option>
                    @endif
                </select>
                {{ $errors->first('gioitinh') }}
            </div>

            <div class="mb-3">
                <label for="ngaysinh" class="form-label">Ngày sinh</label>
                <input type="date" value="{{ $data->ngaysinh }}" class="form-control" id="ngaysinh" name="ngaysinh">
                {{ $errors->first('ngaysinh') }}
            </div>

            <div class="mb-3">
                <label for="diachi" class="form-label">Địa chỉ</label>
                <input type="text" value="{{ $data->diachi }}" class="form-control" id="diachi" name="diachi">
                {{ $errors->first('diachi') }}
            </div>
            <div class="mb-3">
                <label for="sdt" class="form-label">SĐT</label>
                <input type="text" value="{{ $data->sdt }}" class="form-control" id="sdt" name="sdt">
                {{ $errors->first('sdt') }}
            </div>
            <div class="mb-3">
                <label for="privilege">Quyền</q> <span class="text-danger font-weight-bold">*</span></label>
                <select class="custom-select form-control @error('privilege') is-invalid @enderror" id="gioitinh"
                    name="admin">
                    <option value="">-- Choose --</option>
                    @if ($data->admin==1)
                    <option value="0">User</option>
                    <option selected value="1">Admin</option>
                    @else
                    <option selected value="0">User</option>
                    <option  value="1">Admin</option>
                    @endif
                    
                </select>
                {{ $errors->first('admin') }}
            </div>


            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" value="{{ $data->email }}" class="form-control" id="email" name="email">
                {{ $errors->first('email') }}
            </div>
            <div class="mb-3">
                <label for="tendangnhap" class="form-label">Tên đăng nhập</label>
                <input type="text" value="{{ $data->tendangnhap }}" class="form-control" id="tendangnhap"
                    name="tendangnhap">
                {{ $errors->first('tendangnhap') }}
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="text" class="form-control" id="password" name="password">
                {{ $errors->first('password') }}
            </div>


            <button type="submit" class="btn btn-primary">Lưu</button>

        </form>
    </div>
    </div>
@endsection
