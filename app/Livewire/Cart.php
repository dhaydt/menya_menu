<?php

namespace App\Livewire;

use App\CPU\Helpers;
use App\Models\CartGroup;
use Livewire\Component;

class Cart extends Component
{
    public $counter;
    protected $listeners = ['updateCart'];

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
}
