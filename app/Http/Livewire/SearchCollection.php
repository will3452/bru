<?php

namespace App\Http\Livewire;

use App\Art;
use App\Book;
use App\Song;
use App\Audio;
use App\Podcast;
use App\Thrailer;
use App\Collection;
use Livewire\Component;

class SearchCollection extends Component
{
    public $title;
    public $collection;
    public $books;
    public $songs;
    public $podcasts;
    public $arts;
    public $audios;
    public $films;
    public $works;

    public function mount(Collection $collection){
        $this->collection = $collection;
        $this->text = '';
        $this->books = collect();
        $this->songs = collect();
        $this->podcasts = collect();
        $this->arts = collect();
        $this->audios = collect();
        $this->films = collect();
    }

    public function updatedTitle(){
        if($this->title == ''){
            $this->books = collect();
            $this->songs = collect();
            $this->podcasts = collect();
            $this->arts = collect();
            $this->audios = collect();
            $this->films = collect();
            $this->works = 0;
            return;
        }
        $this->works = 1;

        if($this->collection->type_of_work != 'solo'){
            
            $this->books = Book::where('title', 'like', '%'.$this->title.'%')->get();
            $this->songs = Song::where('title', 'like', '%'.$this->title.'%')->get();
            $this->podcasts = Podcast::where('title', 'like', '%'.$this->title.'%')->get();
            $this->arts = Art::where('title', 'like', '%'.$this->title.'%')->get();
            $this->audios = Audio::where('title', 'like', '%'.$this->title.'%')->get();
            $this->films = Thrailer::where('title', 'like', '%'.$this->title.'%')->get();
        }else {
            $this->books = auth()->user()->books()->where('title', 'like', '%'.$this->title.'%')->get();
            $this->songs = auth()->user()->songs()->where('title', 'like', '%'.$this->title.'%')->get();
            $this->podcasts = auth()->user()->podcasts()->where('title', 'like', '%'.$this->title.'%')->get();
            $this->arts = auth()->user()->arts()->where('title', 'like', '%'.$this->title.'%')->get();
            $this->audios = auth()->user()->audio()->where('title', 'like', '%'.$this->title.'%')->get();
            $this->films = auth()->user()->thrailers()->where('title', 'like', '%'.$this->title.'%')->get();
        }
        
    }
    public function render()
    {
        return view('livewire.search-collection');
    }
}
