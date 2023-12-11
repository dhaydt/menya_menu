<?php

namespace App\Livewire\Pages\Category;

use App\Models\Food;
use Livewire\Component;

class ListCat extends Component
{
    public $item = [];

    public function render()
    {
        return view('livewire.pages.category.list-cat');
    }

    public function mount($id){
        $this->item = Food::where(['category_id' => $id, 'type' => 'food'])->get();
    }
}
