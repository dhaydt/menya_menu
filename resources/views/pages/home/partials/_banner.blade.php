<!-- Set up your HTML -->
<style>
  .carousel-wrapper .owl-item{
    min-height: 44vw;
    height: 44vw;
    border-radius: 15px;
    overflow: hidden;
  }

  .carousel-wrapper .owl-item div{
    height: 44vw;
  }

  .carousel-wrapper img{
    height: 100%;
  }

  .carousel-wrapper .owl-theme .owl-nav.disabled+.owl-dots{
    margin-top: 5px;
  }

  .carousel-wrapper .owl-theme .owl-dots, .owl-theme .owl-nav{
    text-align: left;
  }

  .carousel-wrapper .owl-theme .owl-dots .owl-dot span{
    margin: 5px 4px;
  }
</style>
<div class="carousel-wrapper">
  <div class="owl-carousel owl-theme owl-banner">
    <div>
      <img src="{{ asset('assets/images/banner/banner.png') }}" class="h-100 animate__backInRight" alt="">
    </div>
    <div>
      <img src="{{ asset('assets/images/banner/banner2.jpg') }}" class="h-100" alt="">
    </div>
    <div>
      <img src="{{ asset('assets/images/banner/banner.png') }}" class="h-100" alt="">
    </div>
    <div>
      <img src="{{ asset('assets/images/banner/banner2.jpg') }}" class="h-100" alt="">
    </div>
    <div>
      <img src="{{ asset('assets/images/banner/banner.png') }}" class="h-100" alt="">
    </div>
    <div>
      <img src="{{ asset('assets/images/banner/banner2.jpg') }}" class="h-100" alt="">
    </div>
    <div>
      <img src="{{ asset('assets/images/banner/banner.png') }}" class="h-100" alt="">
    </div>
  </div>
</div>

@push('scripts')
  <script>
    $(document).ready(function(){
      $(".owl-banner").owlCarousel({
        items: 1,
        margin: 10,
        loop: true,
        dots: true,
        autoplay: false,
        autoplayTimeout: 5000
      });
    });
  </script>
@endpush