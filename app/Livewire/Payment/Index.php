<?php

namespace App\Livewire\Payment;

use App\CPU\Helpers;
use App\Models\CartGroup;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['generateOrder', 'confirmPayment', 'cancelConfirm'];
    public $subtotal;
    public $total;
    public $tax;
    public $service;
    public $name;
    public $phone;
    public $payment;
    public $table;
    public $taxPercent;
    public $text;
    public $type;

    public $role = [
        "name" => "required",
        "phone" => "required",
        "payment" => "required",
    ];
    
    public $message = [
        "name.required" => "Please input your name",
        "phone" => "Please input your phone number",
        "payment" => "Please select payment type below",
    ];

    public function render()
    {
        return view('livewire.payment.index');
    }

    public function mount(){
        $this->table = Helpers::getTable();

        $group = CartGroup::where('table_id', $this->table)->first();

        if($group){
            $this->subtotal = $group['total'] - $group['tax'] - $group['service_charge'];
    
            $this->total = $group['total'];
            
            $this->tax = $group['tax'];
            
            $this->service = $group['service_charge'];
            
            $this->type = $group['order_type'];
            
            $this->taxPercent = '11 %';
            $this->text = 'CONFIRM';
        }else{
            $this->redirect(route('not_found'));
        }
    }

    public function confirmPayment(){
        $this->validate($this->role, $this->message);
        $this->text = 'PAYMENT';
        $this->dispatch('confirmed');
    }

    public function cancelConfirm(){
        $this->text = 'CONFIRM';
    }

    public function generateOrder(){

        $this->validate($this->role, $this->message);
        session()->put('user_name', $this->name);
        session()->put('phone', $this->phone);
        session()->put('payment', $this->payment);
        session()->put('type', $this->type);

        if($this->payment == 'later'){
            Helpers::generateOrder();
            
            $this->redirect(route('order_success'));
        }else{
            $order_id = Helpers::generateOrder();

            if($order_id){
                session()->put('order_id', $order_id);
    
                $this->redirect(route('pay_now'));
            }

        }

        // dd($this->payment, $this->name, $this->phone);
    }
}
