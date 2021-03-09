<?php

namespace App\Http\Livewire\Admin;

use App\Recommendation;
use Livewire\Component;
use Livewire\WithPagination;

class RecommendationList extends Component
{
    use WithPagination;

    public $option;
    public function mount(){
        $this->option = \App\Remark::first() ? \App\Remark::first()->value : '' ;
    }

    public function updatedOption(){
        $this->render();
    }
    
    public function render()
    {
        $pagie = Recommendation::where('remark',$this->option)->simplePaginate(1);

        return view('livewire.admin.recommendation-list', ['items'=> $pagie ]);
    }
}

