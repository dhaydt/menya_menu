<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryHome extends Component
{
    public $category;

    public function render()
    {
        return view('livewire.category-home');
    }

    public function mount(){
        $this->category = Category::get();
    }
}
