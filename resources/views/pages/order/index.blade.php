@extends('layouts.app')
@section('content')
  <div class="container order-success d-flex flex-column align-items-center justify-content-center">
    <div class="font-title"><h5 class="fw-bold">Order Success</h5></div>
    <div class="check-logo">
      <i class="fa-solid fa-check"></i>
    </div>
    <div class="font-description mt-3">Thank You</div>
    <div class="font-content mt-3 text-center">
      Your order has been received <br> and will be proccess
    </div>
    <div class="next-wrapper mb-3 mt-5 px-2 d-flex align-items-center justify-content-center w-100">
      <a href="{{ route('detail_order', ['id' => session()->get('order_id') ]) }}" class="next-btn" onclick="showLoading()">View Detail Order</a>
    </div>
    <div class="next-wrapper mb-3 mt-2 px-2 d-flex align-items-center order-again justify-content-center w-100">
      <a href="{{ route('menu', ['type' => session()->get('type')]) }}" class="next-btn" onclick="showLoading()">Order Again</a>
    </div>
  </div>
@endsection