<div class="carousel-foods">
  <div class="owl-carousel owl-theme owl-food-{{ $item['id'] }}">
    @foreach ($item['foods'] as $f)
    <a href="{{ route('detail_menu', ['id' => $f['id']]) }}" class="card item-category-card p-0 shadow-sm">
      <div class="card-body p-0">
        <div class="card-category-wrapper">
          <img class="h-100" src="{{ \App\CPU\Helpers::getBackendUrl($f['image']) }}"
            onerror="this.src='{{ asset('assets/images/foods/placeholder.png') }}'" alt="">
        </div>
        <div class="card-category-description p-2">
          <div class="food-name">
            {{ $f['name'] }}
          </div>
          <div class="food-price">
            IDR. {{ number_format(\App\CPU\Helpers::getOutletPrice($f['id'])) }}
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $(".owl-food-" + `{{ $item['id'] }}`).owlCarousel({
            items: 1.8,
            margin: 10,
            loop: false,
            dots: false,
            autoplay: false,
            autoHeight:true
        });
    });
</script>
@endpush