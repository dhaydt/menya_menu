<?php

namespace App\Livewire;

use App\CPU\Helpers;
use App\Models\Cart as ModelsCart;
use App\Models\CartGroup;
use App\Models\Food;
use Livewire\Component;

class Cart extends Component
{
    public $counter;
    protected $listeners = ['updateCart', 'addCartGlobal'];

    public function render()
    {
        $table = Helpers::getTable();
        $cart = CartGroup::where('table_id', $table)->get();
        $counter = 0;

        foreach($cart as $g){
            $item = $g['cart'];
            foreach($item as $i){
                if($i['parent_id'] == 0){
                    $counter += 1;
                }
            }
        }

        $this->counter = $counter;
        return view('livewire.cart');
    }

    public function updateCart(){
        $table = Helpers::getTable();
        $cart = CartGroup::where('table_id', $table)->get();
        $counter = 0;

        foreach($cart as $g){
            $item = $g['cart'];
            foreach($item as $i){
                if($i['parent_id'] == 0){
                    $counter += 1;
                }
            }
        }

        $this->counter = $counter;
    }

    public function addCartGlobal($id){
        $checkCart = CartGroup::where('table_id', session()->get('table'))->first();

        $food = Food::find($id);
        $price = Helpers::getOutletPrice($id);

        $group_id = Helpers::token(10);

        if($checkCart){

            $cartGroup = $checkCart;
            $group_id = $cartGroup['group_id'];
            $cartGroup->total += $price;

        }else{
            $cartGroup = new CartGroup();
            $cartGroup->total = $price;
        }

            $cartGroup->group_id = $group_id;
            $cartGroup->order_type = session()->get('type');
            $cartGroup->table_id = session()->get('table');
        
            $cartGroup->save();

            $checkProduct = ModelsCart::where(['food_id' => $id, 'group_id' => $group_id])->first();

            if($checkProduct){
                $cart = $checkProduct;
                $cart->qty += 1;
                $cart->total += $price;
            }else{
                $cart = new ModelsCart();
                $cart->qty = 1;
                $cart->total = $price;
            }


            $cart->group_id = $group_id;
            $cart->food_id = $id;
            $cart->price = $price;

            $cart->save();


        $this->dispatch('updateCart');
        $this->dispatch('addedCart', 1, 'Successfully added to cart!');

    }
}
