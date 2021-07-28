<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateEvent extends Component
{
    public $work = 'yes';
    public $content ='solo';
    public $worktype = 'book';
    public $works = [];
    public $grouptype = 'series';
    public $groups = [];

    public function mount(){
        $this->works = auth()->user()->books()->whereNotNull('publish_date')->get();
        $this->groups = auth()->user()->series;
    }
    
    public function updatedWorktype(){
        if($this->worktype == 'book'){
            $this->works = auth()->user()->books()->whereNotNull('publish_date')->get();
        }else if($this->worktype == 'art'){
            $this->works = auth()->user()->arts;
        }else if($this->worktype == 'film'){
            $this->works = auth()->user()->thrailers;
        }else if($this->worktype == 'song'){
            $this->works = auth()->user()->songs;
        }else if($this->worktype == 'audio'){
            $this->works = auth()->user()->audio;
        }else if($this->worktype == 'podcast'){
            $this->works = auth()->user()->podcasts;
        }
    }

    public function updatedGrouptype(){
        if($this->grouptype == 'series'){
            $this->groups = auth()->user()->series;
        }else if($this->grouptype == 'collection'){
            $this->groups = auth()->user()->collections;
        }else if($this->grouptype == 'collection'){
            $this->groups = auth()->user()->albums;
        }
    }
    
    public function render()
    {
        return view('livewire.create-event');
    }
}
