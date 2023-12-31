<?php

namespace App\Livewire\Order;

use App\CPU\Helpers;
use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Component;

class Detail extends Component
{
    public $order_id;
    public $order;
    public $items;
    public $outlet;

    public function render()
    {
        $table = Helpers::getTableId();

        $this->order = Order::find($this->order_id);

        $order = $this->order;

        $items = OrderDetail::where(['order_id' => $order['id'], 'parent_id' => 0])->get();

        foreach($items as $i){
            $i['topping'] = OrderDetail::where(['order_id' => $order['id'], 'parent_id' => $i['food_id']])->get();
        }

        $this->items = $items;

        $data['order'] = $this->order;
        $data['items'] = $items;        

        $this->outlet = Helpers::getOutlet($this->order['table']['outlet_id']);

        return view('livewire.order.detail', $data);
    }

    public function mount($id){
        $this->order_id = $id;
    }

    public function pay_now($order_id){
        session()->put('order_id', $order_id);

        // $this->redirect(route('pay_now'));

        session()->put('payment_method', 'QRIS');

        $this->redirect(route('generateInvoice'));
    }
}
