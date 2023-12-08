<div class="mt-2">
    <div class="row category-section">
        <div class="carousel-category">
            <div class="owl-carousel owl-theme owl-category">
                @foreach ($category as $c)
                @include('livewire.partials.item-category', ['data' => $c])
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $(".owl-category").owlCarousel({
            items: 4,
            margin: 10,
            loop: false,
            dots: true,
            autoplay: false,
            autoHeight:true
        });
    });
</script>
@endpush