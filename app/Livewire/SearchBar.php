<?php

namespace App\Livewire;

use App\Models\Food;
use Livewire\Component;

class SearchBar extends Component
{
    protected $listeners = ['search'];
    public $search;
    public $result = [];

    public function render()
    {
        return view('livewire.search-bar');
    }

    public function search(){
        $res = Food::when($this->search, function($query){
            $query->where('name', 'like', '%'.$this->search.'%');
        })->where('type', 'food')->limit(10)->get()->pluck('name', 'id');

        $this->result = $res;
    }
}
