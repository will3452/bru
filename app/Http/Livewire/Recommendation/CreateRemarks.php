<?php

namespace App\Http\Livewire\Recommendation;

use App\Remark;
use Livewire\Component;

class CreateRemarks extends Component
{
    public $value = "";
    public $done = false;
    protected $rules = [
        'value'=>'required'
    ];
    public function submit(){
        $this->validate();
        Remark::create(['value'=>$this->value]);

        $this->value = '';
        $this->done = true;
        $this->emitTo('recommendation.list-remarks', 'remarksAdded');


    }
    public function render()
    {
        return view('livewire.recommendation.create-remarks');
    }
}
