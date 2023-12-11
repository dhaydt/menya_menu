<div class="pt-1">
    @foreach ($item as $i)
    <div class="card item-category mt-2">
        <div class="card-body p-2">
            <div class="d-flex justify-content-start">
                <div class="img-wrapper me-2">
                    <img src="{{ \App\CPU\Helpers::getBackendUrl($i['image']) }}" height="100px" width="100px" onerror="this.src=`{{ asset('assets/images/foods/placeholder.png') }}`" alt="food">
                </div>
                <div class="w-100 d-flex justify-content-between flex-column description-category">
                    <div class="text-content text-capitalize">{{ $i['name'] }}</div>
                    <div class="d-flex justify-content-between">
                        <div class="text-price pb-2">IDR. {{ number_format(\App\CPU\Helpers::getOutletPrice($i['id'])) }}</div>
                        <a href="javascript:" wire:click="$dispatch('addCartCategories', {{ $i['id'] }})" class="text-btn">ADD <i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@push('scripts')
    <script>
        Livewire.on('addCartCategories', (id) => {
            @this.dispatch('addCartGlobal', {id: id});
        })

        Livewire.on("addedCart", (status) => {        
            alertMessage(status)
        })
    </script>
@endpush