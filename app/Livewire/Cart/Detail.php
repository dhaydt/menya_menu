<?php

namespace App\Livewire\Cart;

use App\CPU\Helpers;
use App\Models\Cart;
use App\Models\CartGroup;
use App\Models\Order;
use Livewire\Component;

class Detail extends Component
{
    protected $listeners = ['getData','generateOrder','deleteFoods', 'deleteToppings', 'calculate','addQtyFoods', 'minQtyFoods', 'addQtyTopping', 'minQtyTopping','refreshCart' => '$refresh'];

    public $cart = [];
    public $tax = 0;
    public $service = 0;
    public $subtotal = [
        'subtotal' => [],
        'tax' => 0,
        'service' => 0,
        'total' => 0
    ];
    public $note;

    public function render()
    {
        return view('livewire.cart.detail');
    }

    public function mount(){
    }

    public function getData(){
        $table = Helpers::getTable();
        $group = CartGroup::where('table_id', $table)->get();

        $this->tax = Helpers::getConfig('tax')['value'] ?? 0;
        $this->service = Helpers::getConfig('service_charge')['value'] ?? 0;

        $this->subtotal['tax'] = $this->tax;
        $this->subtotal['service'] = $this->service;
        

        if(count($group) > 0){
            $this->note = $group[0]['note'];
    
    
            
            foreach ($group as $g) {
    
                
                $item = $g['cart'];
    
                if (count($item) < 1) {
                    $this->dispatch('emptyCart', 0, 'Cart is empty!');
        
                    $this->redirectRoute('menu', ['type' => session()->get('type')]);
                }
    
                foreach ($item as $i) {
                    if ($i['parent_id'] == 0) {
                        $topping = Cart::where(['group_id' => $g['group_id'], 'parent_id' => $i['food_id']])->get();
    
                        $tgropu = [];
                        
                        foreach ($topping as $t) {
                            $tgropu[$t['id']] = [
                                'name' => $t['food']['name'] ?? 'Invalid data',
                                'qty' => $t['qty'],
                                'price' => $t['price'],
                            ];
                        }
                        
                        $this->cart[$i['id']] = [
                            'name' => $i['food']['name'],
                            'qty' => $i['qty'],
                            'price' => $i['price'],
                            'topping' => $tgropu
                        ];
                    }
                }
            }
        }else{
            $this->redirect(route('not_found'));
        }
    }

    public function resetSubTotal(){
        $this->subtotal = [
            'subtotal' => [],
            'tax' => $this->tax,
            'service' => $this->service,
            'total' => 0
        ];
    }

    public function calculate(){
        $this->resetSubTotal();

        foreach($this->cart as $c){
            $val = $c['qty'] * $c['price'];

            array_push($this->subtotal['subtotal'], $val);

            foreach($c['topping'] as $t){
                $val2 = $t['qty'] * $t['price'];
                array_push($this->subtotal['subtotal'], $val2);
            }
        }
    }

    public function addQtyFoods($key, $qty){
        $this->cart[$key]['qty'] = $qty+1;

        $this->calculate();
    }
    
    public function minQtyFoods($key, $qty){
        $qty = $qty - 1;

        if($qty == 0){
            $this->dispatch('deleteCart', 0, 'QTY cant be 0 !');
        }else{
            $this->cart[$key]['qty'] = $qty;
        }

        $this->calculate();
    }

    public function addQtyTopping($k, $kt, $qty){
        $this->cart[$k]['topping'][$kt]['qty'] = $qty + 1;

        $this->calculate();
    }

    public function minQtyTopping($k, $kt, $qty){
        $qty = $qty - 1;

        if($qty == 0){
            $this->dispatch('deleteCart', 0, 'QTY cant be 0 !');
        }else{
            $this->cart[$k]['topping'][$kt]['qty'] = $qty;
        }
        
        $this->calculate();
    }

    public function deleteFoods($key){
        $cart = Cart::find($key);
        if($cart){
            $topping = Cart::where(['group_id' => $cart['group_id'], 'parent_id' => $cart['food_id']])->get();
            foreach ($topping as $key => $t) {
                $t->delete();
            }

            $cart->delete();

            $this->dispatch('deleteCart', 1, 'Successfully delete cart item!');
        }else{
            $this->dispatch('deleteCart', 0, 'Cart not found!');
        }
    }

    public function generateOrder(){

        $total = array_sum($this->subtotal['subtotal']) + $this->service + Helpers::getTax($this->tax, array_sum($this->subtotal['subtotal']));

        $table = Helpers::getTable();

        $group = CartGroup::where('table_id', $table)->first();
        $group->total = $total;
        $group->note = $this->note;
        $group->tax = Helpers::getTax($this->tax, array_sum($this->subtotal['subtotal']));
        $group->service_charge = $this->service;
        $group->save();

        foreach ($this->cart as $k => $c) {
            $food = Cart::find($k);
            if($food){
                $food->qty = $c['qty'];
                $food->total = $c['qty'] * $c['price'];

                $food->save();
            }

            foreach($c['topping'] as $kt => $t){

                $topping = Cart::find($kt);

                if($topping){
                    $topping->qty = $t['qty'];
                    $topping->total = $t['qty'] * $t['price'];

                    $topping->save();
                }
            }
        }

        $this->redirect(route('payment-method'));
    }

    public function deleteToppings($key){
        $cart = Cart::find($key);
        if($cart){
            $cart->delete();

            $this->dispatch('deleteCart', 1, 'Successfully delete cart item!');
        }else{
            $this->dispatch('deleteCart', 0, 'Cart not found!');
        }
    }
}
