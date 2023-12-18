<div>
    @foreach ($cart as $k => $g)
    <div class="item-cart pb-2 mb-2">
        <div class="main-item">
            <div class="d-flex justify-content-between align-items-center px-2">
                <div class="font-description">
                    {{ $g['name'] }}
                </div>
                <div class="input-group qty-input align-items-center">
                    <span class="input-group-btn">
                        <button type="button" wire:click="minQtyFoods({{ $k }}, {{ $cart[$k]['qty'] }} )"
                            class="btn btn-secondary btn-sm btn-number" data-type="minus" data-field="qty">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </span>
                    <input type="text" class="form-control input-number" wire:model="cart.{{ $k }}.qty"
                        min="1">
                    <span class="input-group-btn">
                        {{-- <button type="button" wire:click="$dispatch('addQtyFood', [{{ $k }}, {{ $cart[$k]['qty'] }}] )" --}}
                        <button type="button" wire:click="addQtyFoods({{ $k }}, {{ $cart[$k]['qty'] }} )"
                            class="btn btn-secondary btn-sm btn-number" data-type="plus" data-field="qty">
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center px-2 mt-2">
                <div class="qty-count font-description cart-font">
                    x1 IDR {{ number_format($g['price']) }}
                </div>
                <div class="qty-total font-description cart-font">
                    Total IDR {{ number_format($g['price'] * $cart[$k]['qty']) }}
                </div>
            </div>
            <div class="delete-btn d-flex p-2">
                <a href="javascript:" wire:click="$dispatch('deleteFood', {{ $k }})"
                    class="btn-delete ms-auto">Delete</a>
            </div>
        </div>
        <small class="label-title d-block p-2">Topping</small>
        @if($g['topping'])
        @foreach ($g['topping'] as $kt => $t)
        <div class="second-item px-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="font-description">
                    {{ $t['name'] }}
                </div>
                <div class="input-group qty-input align-items-center">
                    <span class="input-group-btn">
                        <button type="button" wire:click="minQtyTopping({{ $k }}, {{ $kt }},{{ $cart[$k]['topping'][$kt]['qty'] }} )"
                            class="btn btn-secondary btn-sm btn-number" data-type="minus" data-field="qty">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </span>
                    <input type="text" name="qty" class="form-control input-number"
                        wire:model="cart.{{ $k }}.topping.{{ $kt }}.qty" min="1">
                    <span class="input-group-btn">
                        <button type="button" wire:click="addQtyTopping({{ $k }}, {{ $kt }},{{ $cart[$k]['topping'][$kt]['qty'] }} )"
                            class="btn btn-secondary btn-sm btn-number" data-type="plus" data-field="qty">
                            <i class="fa-solid fa-plus text-white"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center px-2 mt-2">
                <div class="qty-count font-description cart-font">
                    x1 IDR {{ number_format($t['price']) }}
                </div>
                <div class="qty-total font-description cart-font">
                    Total IDR {{ number_format($t['price'] * $cart[$k]['topping'][$kt]['qty']) }}
                </div>
            </div>
            <div class="delete-btn d-flex p-2">
                <a href="javascript:" wire:click="$dispatch('deleteTopping', {{ $kt }})"
                    class="btn-delete ms-auto">Delete</a>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    @endforeach
    <div class="note-wrapper row d-flex p-2">
        <div class="col-1 note-text ps-0">
            Note:
        </div>
        <div class="col-11 ps-2">
            <textarea name="" class="form-control" rows="3" wire:model="note"></textarea>
        </div>
    </div>
    <div class="border-line"></div>
    <div class="add-item-wrapper d-flex justify-content-center my-2 px-2">
        <a href="{{ route('menu', ['type' => session()->get('type')]) }}" class="add-item-btn text-center">
            <i class="fa-solid fa-plus me-1"></i>
            ADD ITEM
        </a>
    </div>
    <div class="border-line"></div>
    <div class="cart-counter mt-2">
        <div class="d-flex justify-content-end baris-harga">
            <div class="name me-3">
                Sub total
            </div>
            <div class="price">
                IDR. {{ number_format(array_sum($subtotal['subtotal'])) }}
            </div>
        </div>
        <div class="d-flex justify-content-end baris-harga">
            <div class="name me-3">
                Tax ({{ $subtotal['tax'] }} %)
            </div>
            <div class="price">
                IDR. {{ number_format(\App\CPU\Helpers::getTax($subtotal['tax'], array_sum($subtotal['subtotal'])))  }}
            </div>
        </div>
        <div class="d-flex justify-content-end baris-harga">
            <div class="name me-3">
                Service Charge
            </div>
            <div class="price">
                IDR. {{ number_format($subtotal['service']) }}
            </div>
        </div>
        <div class="d-flex justify-content-end baris-harga">
            <div class="name me-3 fw-bold">
                Total
            </div>
            <div class="price fw-bold">
                IDR. {{ number_format(array_sum($subtotal['subtotal']) + \App\CPU\Helpers::getTax($subtotal['tax'], array_sum($subtotal['subtotal'])) + $subtotal['service']) }}
            </div>
        </div>
    </div>
    <div class="next-wrapper mb-3 mt-5 px-2 d-flex align-items-center justify-content-center">
        <a href="javascript:" wire:click="generateOrder" class="next-btn" onclick="showLoading()">NEXT</a>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        Livewire.dispatch('calculate');
    })

    Livewire.on("emptyCart", (status) => {        
        alertMessage(status)
    })

    Livewire.on('deleteFood', (id)=>{
        console.log('id', id);
        @this.dispatch('deleteFoods', {key : id});
    })
    
    Livewire.on('deleteTopping', (id)=>{
        console.log('id', id);
        @this.dispatch('deleteToppings', {key : id});
    })

    Livewire.on("deleteCart", (status) => {  
        @this.dispatch('refreshCart');
        alertMessage(status)
    })
</script>
@endpush