<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class MarketingCreate extends Component
{
    public $category = 1;
    public $hasImageBanner = 0;
    public $duration = '';
    public $proceed_contract = 1;

    public function updatedCategory(){
        return redirect(route('marketing.create').'?category='.$this->category);
    }

    public function mount($category){
        $this->category = $category;
    }
    public function render()
    {
        return view('livewire.marketing-create');
    }
}
