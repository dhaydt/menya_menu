<div>
    <div class="container py-2 payment-information">
        <div class="font-title mb-2">
            Methode Payment
        </div>
        <div class="form-check bg-lights">
            <label class="form-check-label w-100" for="now">
                <img src="{{ asset('assets/images/qris.png') }}" height="20px" alt="qris">
                <input class="form-check-input" type="radio" name="payment_method" id="now" value="QRIS"
                    wire:model="payment">
            </label>
        </div>
        <div class="form-check bg-lights mt-2">
            <label class="form-check-label w-100" for="later">
                <img src="{{ asset('assets/images/bca.png') }}" height="20px" alt="bca">
                <input class="form-check-input" type="radio" name="payment_method" id="later" value="BCA"
                    wire:model="payment">
            </label>
        </div>
        <div class="next-wrapper mb-3 mt-5 px-2 d-flex align-items-center justify-content-center">
            <a href="javascript:" wire:click="generateInvoice" class="next-btn" onclick="showLoading()">CONFIRM PAYMENT</a>
        </div>
    </div>
</div>