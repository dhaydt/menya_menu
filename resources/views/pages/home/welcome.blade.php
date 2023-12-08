@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="container page-welcome">
      <div class="page-title text-center">
        <h3>
          WELCOME
        </h3>
      </div>
      <div class="page-content text-center">
        <h6>Please Choose</h6>
        <div class="d-flex align-items-center justify-content-evenly mt-3">
          <a href="{{ route('menu', ['type' => 'dine_in']) }}" class="card-single">
            <div class="icon-wrapper">
              <img src="{{ asset('assets/images/welcome/dinein.png') }}" alt="">
            </div>
            <div class="icon-title">
              DINE IN
            </div>
          </a>
          <a href="{{ route('menu', ['type' => 'take_away']) }}" class="card-single">
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