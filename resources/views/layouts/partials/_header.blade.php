@if ($route == 'menu')
<div class="nav-header d-flex">
  @livewire('search-bar')
  <div class="card-tool d-flex justify-content-center pe-2">
    <a href="{{ route('bill') }}" class="p-2 my-auto position-relative counter-anchor" onclick="showLoading()">
      <i class="fa-solid fa-scroll"></i>
      @livewire('bill')
    </a>
    <a href="{{ route('cart_detail') }}" class="p-2 my-auto position-relative counter-anchor" onclick="showLoading()">
      <i class="fa-solid fa-cart-shopping"></i>
      @livewire('cart')
    </a>
  </div>
</div>
@elseif($route == 'detail_menu' || $route == 'banner' || $route == 'cart_detail' || $route == 'payment-method' || $route == 'order_success' || $route == 'detail_order' || $route == 'bill' || $route == 'pay_now' || $route == 'category' || $route == 'request_payment')
<div class="nav-header d-flex justify-content-between nav-pages">
  <div class="header-title d-flex align-items-center justify-content-center ps-3">
    {{-- <a href="{{ route('menu', ['type' => session()->get('type')]) }}" class="back-btn me-3 position-relative counter-anchor"> --}}
    <a href="{{ url()->previous() }}" class="back-btn me-3 position-relative counter-anchor" onclick="showLoading()">
      <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div class="title">
      {{ $title }}
    </div>
  </div>
  @if ($route !== 'cart_detail' && $route !== 'payment-method' && $route !== 'order_success' && $route !== 'detail_order' && $route !== 'bill' && $route !== 'pay_now' && $route !== 'request_payment')
  <div class="card-tool d-flex justify-content-center pe-2">
    <a href="{{ route('cart_detail') }}" class="p-2 my-auto position-relative counter-anchor" onclick="showLoading()">
      <i class="fa-solid fa-cart-shopping"></i>
      @livewire('cart')
    </a>
  </div>
  @endif
  <a href="{{ route('menu', ['type' => session()->get('type')]) }}" onclick="showLoading()" class="home-btn me-3 home-btn"><i class="fa-solid fa-home"></i></a>
</div>
@endif