@if ($route == 'menu')
<div class="nav-header d-flex">
  <div class="search-nav p-2 d-flex align-items-center">
    <div class="input-group">
      <span class="input-group-text">
        <i class="fa-solid fa-search"></i>
      </span>
      <div class="form-floating">
        <input type="text" class="form-control p-1" id="floatingInputGroup1" placeholder="Search menu">
        <label for="floatingInputGroup1" class="p-2">Search</label>
      </div>
    </div>
  </div>
  <div class="card-tool d-flex justify-content-center pe-2">
    <a href="{{ route('bill') }}" class="p-2 my-auto position-relative counter-anchor">
      <i class="fa-solid fa-scroll"></i>
      @livewire('bill')
    </a>
    <a href="{{ route('cart_detail') }}" class="p-2 my-auto position-relative counter-anchor">
      <i class="fa-solid fa-cart-shopping"></i>
      @livewire('cart')
    </a>
  </div>
</div>
@elseif($route == 'detail_menu' || $route == 'cart_detail' || $route == 'payment-method' || $route == 'order_success' || $route == 'detail_order' || $route == 'bill')
<div class="nav-header d-flex justify-content-between nav-pages">
  <div class="header-title d-flex align-items-center justify-content-center ps-3">
    {{-- <a href="{{ route('menu', ['type' => session()->get('type')]) }}" class="back-btn me-3 position-relative counter-anchor"> --}}
    <a href="{{ url()->previous() }}" class="back-btn me-3 position-relative counter-anchor">
      <i class="fa-solid fa-arrow-left"></i>
    </a>
    <div class="title">
      {{ $title }}
    </div>
  </div>
  @if ($route !== 'cart_detail' && $route !== 'payment-method' && $route !== 'order_success' && $route !== 'detail_order' && $route !== 'bill')
  <div class="card-tool d-flex justify-content-center pe-2">
    <a href="{{ route('cart_detail') }}" class="p-2 my-auto position-relative counter-anchor">
      <i class="fa-solid fa-cart-shopping"></i>
      @livewire('cart')
    </a>
  </div>
  @endif
</div>
@endif