<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class MarketingCreate extends Component
{
    public $category = 1;
    public $hasImageBanner = 0;
    

    public function mount(){
        $this->category = 3;
    }
    public function render()
    {
        return view('livewire.marketing-create');
    }
}
