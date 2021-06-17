<?php

namespace App\Http\Livewire;

use App\Series;
use Livewire\Component;

class SearchSeries extends Component
{
    public $title;
    public $series;
    public $works;
    public $type;

    public function mount(Series $series){
        $this->series = $series;
        $this->text = '';
        $this->works = collect();
        $this->type = $series->type;
    }

    public function updatedTitle(){
        if($this->title == ''){
            $this->works = collect();
            return;
        }
        if($this->type == 'book'){
            $this->works = auth()->user()->books()->where('title', 'like', '%'.$this->title.'%')->get();
        }
        if($this->type == 'audio book'){
            $this->works = auth()->user()->audio()->where('title', 'like', '%'.$this->title.'%')->get();
        }
        if($this->type == 'film'){
            $this->works = auth()->user()->thrailers()->where('title', 'like', '%'.$this->title.'%')->get();
        }
        if($this->type == 'podcast'){
            $this->works = auth()->user()->podcasts()->where('title', 'like', '%'.$this->title.'%')->get();
        }
    }

    
    public function render()
    {
        return view('livewire.search-series');
    }
}
