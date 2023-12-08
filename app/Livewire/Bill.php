<?php

namespace App\Livewire;

use App\CPU\Helpers;
use App\Models\Order;
use Livewire\Component;

class Bill extends Component
{
    public $counter;
    protected $listeners = ['updateCart'];

    public function render()
    {
        $table = Helpers::getTableId();
        $this->counter = Order::where(['table_id' => $table, 'on_going' => 1])->count();
        return view('livewire.bill');
    }
}
