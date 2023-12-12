@extends('layouts.site')
@section('main')
<div class="untree_co-section">
    <div class="container">
      
      <div class="row">
        <div class="col-md-6 mb-5 mb-md-0">
          <h2 class="h3 mb-3 text-black">Billing Details</h2>
          <div class="p-3 p-lg-5 border bg-white">
            <div class="form-group">
                <label for="c_fname" class="text-black">Địa chỉ <span class="text-danger">*</span></label>
                <input value="{{Auth::user()->diachi}}" type="text" class="form-control" id="c_fname" name="c_fname">
             
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_fname" class="text-black">Họ và tên <span class="text-danger">*</span></label>
                <input value="{{Auth::user()->hovaten}}" type="text" class="form-control" id="c_fname" name="c_fname">
            </div>
              
            </div>

          


           

          

            <div class="form-group row mb-5">
              <div class="col-md-12">
                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                <input value="{{Auth::user()->email}}" type="text" class="form-control" id="c_email_address" name="c_email_address">
              </div>
              <div class="col-md-12">
                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                <input value="{{Auth::user()->sdt}}" type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
              </div>
            </div>

          </div>
        </div>
        <div class="col-md-6">

         

          <div class="row mb-5">
            <div class="col-md-12">
              <h2 class="h3 mb-3 text-black">Your Order</h2>
              <div class="p-3 p-lg-5 border bg-white">
                <table class="table site-block-order-table mb-5">
                  <thead>
                    <th>Sản phẩm</th>
                    <th>Total</th>
                  </thead>
                  <tbody>
                    @foreach ($cart->items as $item)
                     <tr>
                        <td>{{$item['tensp']}} <strong class="mx-2">x</strong>{{$item['soluong']}}</td>
                        <td>{{number_format($item['soluong']*$item['gia'])}} VND</td>
                      </tr>
                        
                    @endforeach
                  
                    
                  
                    <tr>
                      <td class="text-black font-weight-bold"><strong>Tổng thành tiền</strong></td>
                      <td class="text-black font-weight-bold"><strong>{{number_format($cart->getGia())}} VND</strong></td>
                    </tr>
                  </tbody>
                </table>

                

                <div class="form-group">
                  <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='{{route('home.pay')}}'">Thanh Toán</button>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- </form> -->
    </div>
  </div>
@endsection