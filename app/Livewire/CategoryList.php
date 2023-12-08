<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public $category;
    
    public function render()
    {
        return view('livewire.category-list');
    }

    public function mount(){
        $this->category = Category::with('foods')->whereHas('foods', function($q){
            $q->where('type', 'food')
            ->where('is_active', 1);
        })->get();
    }
}
