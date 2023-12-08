<?php

namespace App\Livewire\Payment;

use Livewire\Component;

class PayNow extends Component
{
    public $payment;

    public function render()
    {
        return view('livewire.payment.pay-now');
    }

    public function generateInvoice(){
        session()->put('payment_method', $this->payment);

        $this->redirect(route('generateInvoice'));
    }
}
