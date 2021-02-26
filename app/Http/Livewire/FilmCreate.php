<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FilmCreate extends Component
{
    use WithFileUploads;
    
    public $category = 'trailer';
    public $partOfEvent;
    public $hasPreview;
    public $preview;
    public function render()
    {
        return view('livewire.film-create');
    }
}
