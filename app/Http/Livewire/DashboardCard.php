<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardCard extends Component
{
    public $count;
    public $item;
    public $details;
    public $icon;
    public $color;
    public function mount($count, $item, $details = [], $icon="fa-book", $color="primary"){
        $this->count = $count;
        $this->item = $item;
        $this->details = $details;
        $this->icon = $icon;
        $this->color = $color;
    }
    public function render()
    {
        return view('livewire.dashboard-card');
    }
}
