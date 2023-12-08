<div>
    <div class="container pt-2 pb-3">
        @foreach ($bill as $b)
        <a href="{{ route('detail_order', ['id' => $b['id'] ]) }}" class="row py-3 bill-card mt-2 shadow-sm">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-content">No. Order</div>
                        <span>:</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center py-1">
                        <div class="font-content">{{ $b['id'] }}</div>
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
                        <div class="font-content">{{ \App\CPU\Helpers::dateFormat($b['created_at'], 'datetime') }}</div>
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
                        <div class="font-content">{{ $b['payment_method'] }}</div>
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
                        <div class="font-content">{{ $b['table']['name'] ?? "Invalid Table" }} / {{ strtoUpper(str_replace("_"," ",$b['order_type'])) }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-content">Total</div>
                        <span>:</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center py-1">
                        <div class="font-content fw-bold">IDR. {{ number_format($b['total']) }}</div>
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
                            @if ($b['payment_status'] == 'paid')
                            <span class="badge bg-success text-uppercase payment-status">{{ $b['payment_status'] }}</span>
                            @else
                            <span class="badge bg-danger text-uppercase payment-status">{{ $b['payment_status'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="font-content">Status Order</div>
                        <span>:</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center py-1">
                        <div class="font-content">
                            <span class="badge bg-dark payment-status text-uppercase">{{ $b['order_status'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
