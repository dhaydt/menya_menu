<?php

namespace App\Livewire\Bill;

use App\CPU\Helpers;
use App\Models\Order;
use Livewire\Component;

class Detail extends Component
{
    public $bill;

    public function render()
    {
        $table = Helpers::getTableId();

        $this->bill = Order::where(['table_id' => $table, 'on_going' => 1])->whereDate('created_at', date('Y-m-d'))->orderBy('created_at', 'desc')->get();
        
        return view('livewire.bill.detail');
    }
}
