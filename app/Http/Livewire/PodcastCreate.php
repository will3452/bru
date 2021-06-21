<?php

namespace App\Http\Livewire;

use App\Series;
use Livewire\Component;

class PodcastCreate extends Component
{
    public $series;
    public $series_id = '';
    public $part_of = '';
    public $type_of_work = 'solo';
    public $latestEpisode = 1;
    public $group_id = '';
    
    public function mount(){
        $this->series = auth()->user()->series()->where('type', 'podcast')->get();
    }

    public function updatedTypeOfWork(){
        $this->series = auth()->user()->series()->where('type', 'podcast')->get();
    }
    public function updatedSeriesId(){
        if(auth()->user()->series()->find($this->series_id)->podcasts()->count()){
            $this->latestEpisode = auth()->user()->series()->find($this->series_id)->podcasts()->count() + 1;
        }
    }

    public function updatedGroupId(){
        $this->series = auth()->user()->groups()->find($this->group_id)->series;
    }
    public function render()
    {
        return view('livewire.podcast-create');
    }
}
