<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MarketingCreate extends Component
{
    public $category = 1;
    public $hasImageBanner = 0;
    public $duration = '';
    public $proceed_contract = 1;
    public $events;

    public function updatedCategory()
    {
        return redirect(route('marketing.create') . '?category=' . $this->category);
    }

    public function mount($category)
    {
        $this->events = auth()->user()->events()->approved()->get();
        $this->category = $category;
    }
    public function render()
    {
        return view('livewire.marketing-create');
    }
}
