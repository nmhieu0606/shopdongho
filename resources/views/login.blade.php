@extends('layouts/site')
@section('main')
<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="{{route('home.login')}}" method="POST">
            @csrf 
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
              <p class="lead fw-normal mb-0 me-3">Đăng nhập</p>
            
            </div>
  
           
  
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input name="tendangnhap" type="text" id="form3Example3" class="form-control form-control-lg"
                placeholder="Tên đăng nhập" />
              <label class="form-label" for="form3Example3">Tên đăng nhập</label>
            </div>
  
            <!-- Password input -->
            <div class="form-outline mb-3">
              <input name="password" type="password" id="form3Example4" class="form-control form-control-lg"
                placeholder="Nhập mật khẩu" />
              <label class="form-label" for="form3Example4">Mật khẩu</label>
            </div>
  
           
  
            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">Không có tài khoản <a href="{{route('home.postRegister')}}"
                  class="link-danger">Đăng ký</a></p>
            </div>
  
          </form>
        </div>
      </div>
    </div>
   
  </section>
@endsection