@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="container page-welcome">
      <div class="page-title text-center">
        <h3>
          WELCOME
        </h3>
      </div>
      <div class="img-wrapper pt-4 text-center">
        <img src="{{ asset('assets/images/logo.png') }}" height="60px" alt="">
      </div>
      <div class="outlet-data pt-4">
        <div class="page-title text-center text-capitalize">
          <h5>
            {{ $outlet['name'] }}
          </h5>
          <h6 class="pt-4">
            {{ $outlet['address'] }}
          </h6>
        </div>
      </div>
      <div class="page-content text-center">
        <h6>Please Choose</h6>
        <div class="d-flex align-items-center justify-content-evenly mt-3">
          <a href="{{ route('menu', ['type' => 'dine_in']) }}" class="card-single" onclick="showLoading()">
            <div class="icon-wrapper">
              <img src="{{ asset('assets/images/welcome/dinein.png') }}" alt="">
            </div>
            <div class="icon-title">
              DINE IN
            </div>
          </a>
          <a href="{{ route('menu', ['type' => 'take_away']) }}" class="card-single" onclick="showLoading()">
            <div class="icon-wrapper">
              <img src="{{ asset('assets/images/welcome/dinein.png') }}" alt="">
            </div>
            <div class="icon-title">
              TAKE AWAY
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection