@extends('layouts.site')
@section('main')
    <form class="col-md-12" method="post">
        <div class="site-blocks-table">
            <table class="table">
                <thead>
                    <tr>
                        <th class="product-thumbnail">Image</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-total">Total</th>
                        <th class="product-remove">Remove</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($cart->items as $item)
                        <tr>
                            <td class="product-thumbnail">
                                <img src="{{ url('public/uploads') }}/{{ $item['anh'] }}" alt="Image" class="img-fluid">
                            </td>
                            <td class="product-name">
                                <h2 class="h5 text-black">{{ $item['tensp'] }}</h2>
                            </td>
                            <td>{{ number_format($item['gia']) }} VND</td>
                            <td>
                                <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                    style="max-width: 120px;">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('home.down', $item['id']) }}"
                                            class="btn btn-outline-black decrease" type="button">&minus;</a>
                                    </div>
                                    <input disabled type="text" class="form-control text-center quantity-amount"
                                        value="{{ $item['soluong'] }}" placeholder=""
                                        aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <a href="{{ route('home.up', $item['id']) }}" class="btn btn-outline-black increase"
                                            type="button">&plus;</a>
                                    </div>
                                </div>

                            </td>
                            <td>{{ number_format($item['soluong'] * $item['gia']) }} VND</td>
                            <td><a href="{{ route('home.delete', $item['id']) }}" class="btn btn-black btn-sm">X</a></td>
                        </tr>
                    @endforeach



                </tbody>
            </table>
        </div>
    </form>

    <div class="row">
        <div class="col-md-6">
            <div class="row mb-5">
               
                <div class="col-md-6">
                    <a href="{{ route('home.index') }}" class="btn btn-outline-black btn-sm btn-block">Tiếp tục mua sắm</a>
                </div>
            </div>

        </div>
        <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                            <h3 class="text-black h4 text-uppercase">Thông tin giỏ hàng</h3>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <span class="text-black">Tổng tiền</span>
                        </div>
                        <div class="col-md-6 text-right">
                            <strong class="text-black">{{ number_format($cart->getGia()) }} VND</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-black btn-lg py-3 btn-block"
                                onclick="window.location='{{ route('home.checkout') }}'">Thanh Toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
