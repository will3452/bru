<?php

namespace App\Http\Livewire\Recommendation;

use App\Remark;
use Livewire\Component;

class ListRemarks extends Component
{
    public $remarks;
    public $done = false;
    protected $listeners = ['remarksAdded'=>'refresh'];
    public function refresh(){
        $this->remarks = Remark::latest()->get();
        $this->done = false;
    }

    public function remove($id){
        Remark::find($id)->delete();
        $this->refresh();
        $this->done = true;
    }

    public function mount(){
        $this->remarks = Remark::latest()->get();
    }
    
    public function render()
    {
        return view('livewire.recommendation.list-remarks');
    }
}
