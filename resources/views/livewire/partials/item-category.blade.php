<div class="item-category text-center">
  <a href="{{ route('category', ['id' => $c['id']]) }}" class="h-100" onclick="showLoading()">
    <div class="category-wrapper mx-auto h-100">
      <img src="{{ \App\CPU\Helpers::getBackendUrl($data['image']) }}" class="w-100 h-100" alt="category-img" onerror="this.src='{{ asset('assets/images/category/placeholder.png') }}'">
    </div>
    <div class="category-name mt-2">
      {{ $c['category'] }}
    </div>
  </a>
</div>