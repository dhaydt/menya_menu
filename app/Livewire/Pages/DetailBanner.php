<?php

namespace App\Livewire\Pages;

use App\Models\Banner;
use Livewire\Component;

class DetailBanner extends Component
{
    public $banner_id;
    protected $banner;

    public function render()
    {
        $this->banner = Banner::find($this->banner_id);

        $data['banner']= $this->banner;

        return view('livewire.pages.detail-banner', $data);
    }

    public function mount($id){
        $this->banner_id = $id;
    }
}
