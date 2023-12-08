<div>
    <div class="detail-wrapper">
        <div class="image-wrapper" wire:ignore>
            <img class="w-100" src="{{ \App\CPU\Helpers::getBackendUrl($detail['image']) }}" alt="">
        </div>
        <div class="detail-description p-2">
            <div class="font-description">
                {{ $detail['name'] }}
            </div>
            <div class="font-title mt-2 d-flex justify-content-between align-items-center">
                IDR {{ number_format(\App\CPU\Helpers::getOutletPrice($detail['id'])) }}
                <div class="input-group qty-input">
                    <span class="input-group-btn">
                        <button type="button" wire:click="$dispatch('minQty')"
                            class="btn btn-secondary btn-sm btn-number" data-type="minus" data-field="qty">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </span>
                    <input type="text" name="qty" class="form-control input-number" wire:model="qty" min="1">
                    <span class="input-group-btn">
                        <button type="button" wire:click="$dispatch('addQty')"
                            class="btn btn-secondary btn-sm btn-number" data-type="plus" data-field="qty">
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="font-content mt-2">
                {{ $detail['description'] }}
            </div>
        </div>
        <div class="extra-session p-2">
            <div class="extra-food p-3">
                <div class="extra-header">
                    <div class="font-title">
                        Topping
                    </div>
                    <div class="extra-list">
                        @foreach ($lisTopping as $t)
                        <div class="form-check d-flex w-100 ps-0 pe-3 mt-2">
                            <label class="form-check-label title-label" for="flexCheckDefault">
                                {{ $t->name }}
                            </label>
                            <label class="ms-auto">IDR. {{ number_format($t->price) }}</label>
                            <label class="price-check d-flex ms-auto">
                                <input class="form-check-input" type="checkbox" value="false"  name="topping" wire:model="topping.{{ $t->id }}" wire:click="$dispatch('call')">
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="add-cart-session w-100 p-2" wire:click="addCart">
            <div class="add-cart-wrapper d-flex justify-content-between align-items-center text-light p-3">
                <label for="" class="text-uppercase">Add Cart</label>
                <h6 class="m-0">IDR {{ number_format($total) }}</h6>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){

    });

    Livewire.on('addQty', function(){
        var val = @this.qty + 1
        @this.set('qty', val);
        console.log('qty', @this.qty);
    });

    Livewire.on('minQty', function(){
        var val = @this.qty - 1
        if(val != 0){
            @this.set('qty', val);
            console.log('qty', @this.qty);
        }else{
            alert('Minimal QTY is 1')
        }
    });
    
    Livewire.on('call', function(){
        @this.dispatch('calculate');
    });

    Livewire.on("addedCart", (status) => {        
        alertMessage(status)
    })

</script>
@endpush