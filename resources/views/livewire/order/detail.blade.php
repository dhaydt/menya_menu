<div>
    <div class="container">
        @php($route = \Request::route()->getName())
        @if ($route == 'request_payment')
        <div class="font-description text-capitalize py-3">
            Please Information Cashier To Your Order Detail & Payment Option
        </div>
        @else
        <div class="font-description text-capitalize py-3">
            {{ $outlet['name'] }} <br>
            {{ $outlet['address'] }} <br>
            No. Contact : {{ $outlet['phone'] }}
        </div>
        @endif

        <div class="border-line dashed"></div>

        <div class="row py-3">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-content">No. Order</div>
                        <span>:</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center py-1">
                        <div class="font-content">{{ $order['id'] }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-content">Date</div>
                        <span>:</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center py-1">
                        <div class="font-content">{{ \App\CPU\Helpers::dateFormat($order['created_at'], 'datetime') }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-content">Payment</div>
                        <span>:</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center py-1">
                        <div class="font-content">{{ $order['payment_method'] }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-content">Table</div>
                        <span>:</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center py-1">
                        <div class="font-content">{{ $order['table']['name'] ?? "Invalid Table" }} / {{ strtoUpper(str_replace("_"," ",$order['order_type'])) }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-content">Status Payment</div>
                        <span>:</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center py-1">
                        <div class="font-content">
                            @if ($order['payment_status'] == 'paid')
                            <span class="badge bg-success text-uppercase payment-status">{{ $order['payment_status'] }}</span>
                            @else
                            <span class="badge bg-danger text-uppercase payment-status">{{ $order['payment_status'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-line dashed"></div>

        <div class="row py-3">
            <div class="font-title">Order Details</div>
            @foreach ($items as $g)
            <div class="item-cart pb-2" style="border-bottom: unset;">
                <div class="main-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-description">
                            {{ $g['food']['name'] ?? 'Invalid Product' }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="qty-count font-description cart-font">
                            x{{ $g['qty'] }} IDR {{ number_format($g['price']) }}
                        </div>
                        <div class="qty-total font-description cart-font">
                            Total IDR {{ number_format($g['price'] * $g['qty']) }}
                        </div>
                    </div>
                </div>
                <small class="label-title d-block p-2 px-0">Topping</small>
                @if($g['topping'])
                @foreach ($g['topping'] as $kt => $t)
                <div class="second-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-description">
                            {{ $t['food']['name'] ?? 'Invalid topping' }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="qty-count font-description cart-font">
                            x{{ $t['qty'] }} IDR {{ number_format($t['price']) }}
                        </div>
                        <div class="qty-total font-description cart-font">
                            Total IDR {{ number_format($t['price'] * $t['qty']) }}
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            @endforeach
        </div>

        <div class="border-line dashed"></div>

        <div class="cart-counter mt-2">
            <div class="d-flex justify-content-between baris-harga">
                <div class="name me-3">
                    Sub total
                </div>
                <div class="price">
                    IDR. {{ number_format($order['total'] - $order['tax'] - $order['service_charge'] - $order['pembulatan']) }}
                </div>
            </div>
            <div class="d-flex justify-content-between baris-harga">
                <div class="name me-3">
                    Service Charge ({{ \App\CPU\Helpers::getServiceOutlet() }}%)
                </div>
                <div class="price">
                    IDR. {{ number_format($order['service_charge']) }}
                </div>
            </div>
            <div class="d-flex justify-content-between baris-harga">
                <div class="name me-3">
                    Tax ({{ \App\CPU\Helpers::getTaxOutlet() }}%)
                </div>
                <div class="price">
                    IDR. {{ number_format($order['tax']) }}
                </div>
            </div>
            <div class="d-flex justify-content-between baris-harga">
                <div class="name me-3">
                    Rounding
                </div>
                <div class="price">
                    IDR. {{ number_format($order['pembulatan']) }}
                </div>
            </div>
            <div class="d-flex justify-content-between baris-harga">
                <div class="name me-3 fw-bold">
                    Total
                </div>
                <div class="price fw-bold">
                    IDR. {{ number_format($order['total']) }}
                </div>
            </div>
        </div>

        <div class="border-line dashed"></div>

        <div class="d-flex justify-content-between baris-harga">
            <div class="name me-3">
                Status Order
            </div>
            <div class="price">
                <span class="badge bg-dark payment-status text-uppercase">{{ $order['order_status'] }}</span>
            </div>
        </div>
    </div>

    <div class="next-wrapper mb-3 mt-5 px-2 d-flex align-items-center justify-content-center">
        @if($route == 'request_payment')
            <a href="{{ route('menu', ['type' => 'dine_in']) }}" wire:click="generateOrder" class="next-btn" onclick="showLoading()">BACK TO HOME</a>
        @else
        @if ($order['payment_type'] == 'later')
            @if ($order['order_status'] !== 'waiting' && $order['payment_status'] == 'unpaid')
                <a href="{{ route('request_payment', ['id' => $order['id']]) }}" class="next-btn" onclick="showLoading()">REQUEST PAYMENT</a>
            @else
                <a href="{{ route('menu', ['type' => 'dine_in']) }}" wire:click="generateOrder" class="next-btn" onclick="showLoading()">BACK TO HOME</a>
            @endif           
        @else
            @if($order['payment_status'] == 'unpaid')
                <a href="javascript:" wire:click="pay_now(`{{ $order['id'] }}`)" class="next-btn" onclick="showLoading()">PAY NOW</a>
            @else
                <a href="{{ route('menu', ['type' => 'dine_in']) }}" wire:click="generateOrder" class="next-btn" onclick="showLoading()">BACK TO HOME</a>
            @endif
        @endif
        @endif
    </div>
</div>
</div>