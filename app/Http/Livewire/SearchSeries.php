<?php

namespace App\Http\Livewire;

use App\Book;
use App\Audio;
use App\Series;
use App\Podcast;
use App\Thrailer;
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
        if($this->series->type_of_work != 'solo'){
            if($this->type == 'book'){
                $this->works = Book::where('title', 'like', '%'.$this->title.'%')->get();
            }
            if($this->type == 'audio book'){
                $this->works = Audio::where('title', 'like', '%'.$this->title.'%')->get();
            }
            if($this->type == 'film'){
                $this->works =Thrailer::where('title', 'like', '%'.$this->title.'%')->get();
            }
            if($this->type == 'podcast'){
                $this->works = Podcast::where('title', 'like', '%'.$this->title.'%')->get();
            }
        }else {
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
    }

    
    public function render()
    {
        return view('livewire.search-series');
    }
}
