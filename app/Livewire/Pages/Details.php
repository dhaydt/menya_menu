<?php

namespace App\Livewire\Pages;

use App\CPU\Helpers;
use App\Models\Cart;
use App\Models\CartGroup;
use App\Models\Food;
use Livewire\Component;

class Details extends Component
{
    protected $listeners = ['addCart', 'calculate', 'addedCart'];

    protected $detail;

    public $id_detail;

    public $price;

    public $qty = 1;

    public $topping = [];
    
    public $total = 0;

    public $totalTopping = 0;

    public $listTopping = [];

    public $table;
    public $group;
    public $type;

    public function render()
    {
        $this->detail = Food::with('topping')->find($this->id_detail);
        $this->listTopping = $this->detail['topping'];
        // dd($this->detail);
        $this->price = Helpers::getOutletPrice($this->id_detail);

        $data['detail'] = $this->detail;
        $data['lisTopping'] = $this->listTopping;
        $data['price'] = $this->price;
        
        $this->calculateTotal();

        return view('livewire.pages.details', $data);
    }

    public function mount($id){
        $this->id_detail = $id;
        $this->table = session()->get('table');
        $this->type = session()->get('type');
        $this->group = Helpers::token(10);
    }

    public function addCart(){

        $checkCart = CartGroup::where('table_id', session()->get('table'))->first();

        if($checkCart){

            $cartGroup = $checkCart;
            $this->group = $cartGroup['group_id'];
            $cartGroup->total += $this->total;

        }else{
            $cartGroup = new CartGroup();
            $cartGroup->total = $this->total;
        }

            $cartGroup->group_id = $this->group;
            $cartGroup->order_type = $this->type;
            $cartGroup->table_id = $this->table;
        
            $cartGroup->save();

            $checkProduct = Cart::where(['food_id' => $this->id_detail, 'group_id' => $this->group])->first();

            if($checkProduct){
                $cart = $checkProduct;
                $cart->qty += $this->qty;
                $cart->total += $this->price * $this->qty;
            }else{
                $cart = new Cart();
                $cart->qty = $this->qty;
                $cart->total = $this->price * $this->qty;
            }


            $cart->group_id = $this->group;
            $cart->food_id = $this->id_detail;
            $cart->price = $this->price;

            $cart->save();

            foreach($this->topping as $k => $t){
                if($t == true){
                    $tfood = Food::find($k);

                    $checkTopping = Cart::where(['food_id' => $k, 'group_id' => $this->group, 'parent_id' => $this->id_detail])->first();

                    if($checkTopping){
                        $topping = $checkTopping;
                        $topping->qty += 1;
                        $topping->total += $tfood['price'];
                    }else{
                        $topping = new Cart();
                        $topping->qty = 1;
                        $topping->total = $tfood['price'];
                    }

                    
                    $topping->parent_id = $this->id_detail;
                    $topping->group_id = $this->group;
                    $topping->food_id = $k;
                    $topping->price = $tfood['price'];

                    $topping->save();
                }
            }


        $this->dispatch('updateCart');
        $this->dispatch('addedCart', 1, 'Successfully added to cart!');
        // dd('called', $this->topping);
    }

    public function calculate(){
        $price = [];
        foreach($this->topping as $k => $t){
            if($t == true){
                $topping = Food::find($k);

                array_push($price, $topping['price']);
            }
        }

        $this->totalTopping = array_sum($price);

        $this->calculateTotal();
    }

    public function calculateTotal(){
        $price = $this->price * $this->qty;

        $this->total = $price + $this->totalTopping;
    }
}
