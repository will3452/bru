<?php

namespace App\Http\Livewire;

use App\Album;
use Livewire\Component;

class SearchAlbum extends Component
{
    public $title;
    public $album;
    public $works;
    public $type;

    public function mount(Album $album){
        $this->album = $album;
        $this->text = '';
        $this->works = collect();
        $this->type = $album->type;
    }

    public function updatedTitle(){
        if($this->title == ''){
            $this->works = collect();
            return;
        }
        if($this->album->type_of_work != 'solo'){
            if($this->type == 'song'){
                $this->works = Song::where('title', 'like', '%'.$this->title.'%')->get();
            }
            if($this->type == 'art'){
                $this->works = Art::where('title', 'like', '%'.$this->title.'%')->get();
            }
        }else {
            if($this->type == 'song'){
                $this->works = auth()->user()->songs()->where('title', 'like', '%'.$this->title.'%')->get();
            }
            if($this->type == 'art'){
                $this->works = auth()->user()->arts()->where('title', 'like', '%'.$this->title.'%')->get();
            }
        }
    }

    public function render()
    {
        return view('livewire.search-album');
    }
}
