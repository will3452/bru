<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AlbumCreate extends Component
{
    public $type = '';
    public $type_of_work = '';
    public $hasBand = 'no';

    public function render()
    {
        return view('livewire.album-create');
    }
}
