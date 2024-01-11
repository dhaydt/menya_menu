<div class="position-relative payment-method">
    <div class="container py-2">
        <div class="font-description">Bill Details</div>
        <div class="font-content mt-1 d-flex justify-content-between align-items-center">Sub Total <div class="price">
                IDR. {{ number_format($subtotal) }}</div>
        </div>
        <div class="font-content mt-1 d-flex justify-content-between align-items-center">Tax ({{ $taxPercent }})<div
                class="price">IDR. {{ number_format($tax) }}</div>
        </div>
        <div class="font-content mt-1 d-flex justify-content-between align-items-center">Service Charge <div
                class="price">IDR. {{ number_format($service) }}</div>
        </div>
        <div class="font-content fw-bold mt-1 d-flex justify-content-between align-items-center">Total <div
                class="price">IDR. {{ number_format($total) }}</div>
        </div>
    </div>
    <div class="border-line"></div>
    <div class="container py-2 user-information">
        <div class="font-description mb-2">User Information</div>
        <div class="input mb-3">
            <input type="text" class="form-control" placeholder="Name" wire:model="name">
            @error('name')
            <small class="text-danger ps-10px" style="font-size: 10px">{{ $message }}</small>
            @enderror
        </div>
        <div class="input mb-3">
            <input type="number" class="form-control" placeholder="Phone Number" wire:model="phone">
            @error('phone')
            <small class="text-danger" style="font-size: 10px">{{ $message }}</small>
            @enderror
        </div>
    </div>
    
    <div class="border-line"></div>

    <div class="container py-2 user-information">
        <div class="font-description mb-2">Tipe Order</div>
        <select class="form-control" wire:model="type">
            <option value="dine_in">Dine In</option>
            <option value="take_away">Take Away</option>
        </select>
    </div>

    <div class="border-line"></div>
    <div class="container py-2 payment-information">
        <div class="font-description mb-2">
            Optional Payment
        </div>
        @error('payment')
        <small class="text-danger" style="font-size: 10px">{{ $message }}</small>
        @enderror
        <div class="form-check">
            <label class="form-check-label w-100" for="now">
                <div class="fw-bold mb--20">
                    Pay Now (QRIS & BCA Virtual Account)
                </div>
                <br>
                You can pay on phone after order
                <input class="form-check-input mt--5" type="radio" name="payment_method" id="now" value="now"
                    wire:model="payment">
            </label>
        </div>
        <div class="form-check mt-2">
            <label class="form-check-label w-100" for="later">
                <div class="fw-bold mb--20">
                    Pay Later (Cash, Flazz, & Debit Card)
                </div>
                <br>
                You pay at the cashier after the meal
                <input class="form-check-input mt--5" type="radio" name="payment_method" id="later" value="later"
                    wire:model="payment">
            </label>
        </div>
    </div>
    <div class="next-wrapper confirm-btn mb-3 px-2 d-flex align-items-center justify-content-center">
        <a href="javascript:" wire:click="confirmPayment" class="next-btn">{{ $text }}</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="modal-dialog">
                <div class="modal-content pb-3">
                    <div class="modal-body">
                        <div class="font-description fw-bold">Confirm Payment</div>
                        <div class="text-center font-content my-3 mx-3">
                            <span class="fw-bold">Are you sure confirm payment {{ $payment }} ?</span>
                        </div>
                    </div>
                    <div class="d-flex mb-2 row px-3">
                        <div class="col">
                            <button wire:click="cancelConfirm" type="button" class="btn btn-sm btn-outline-secondary w-100" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        <div class="col">
                            <button type="button" wire:click="generateOrder" class="btn-yes btn btn-sm btn-primary w-100" onclick="showLoading()">YES</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    Livewire.on('confirmed', () => {
        console.log('called');

        var myModal = new bootstrap.Modal(document.getElementById('modalConfirm'), {
            keyboard: false
        })
        var modalToggle = document.getElementById('modalConfirm') // relatedTarget
        myModal.show(modalToggle)
    })
</script>
@endpush