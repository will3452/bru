<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class BannerEditor extends Component
{
    public $bookCover;
    use WithFileUploads;

    public function updatedPhoto(){
        $this->validate([
            'bookCover' => 'image|max:1024', // 1MB Max
        ]);
    }
    public function render()
    {
        return view('livewire.banner-editor');
    }
}
