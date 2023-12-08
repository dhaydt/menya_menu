<div class="category-list mt-2">
    @foreach ($category as $c)
    @if(count($c['foods']) > 0)
        <section class="category-item mt-4">
            <div class="section-title">
                <h5 class="text-capitalize">{{ $c['category'] }}</h5>
            </div>
            <div class="section-body">
                @include('livewire.partials.item-product', ['item' => $c])
            </div>
        </section>
    @endif
    @endforeach
</div>
