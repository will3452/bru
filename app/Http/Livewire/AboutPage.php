<?php

namespace App\Http\Livewire;

use App\About;
use Livewire\Component;

class AboutPage extends Component
{
    public $text;
    public $title;
    public $message = null;
    public function mount(){
        $about = About::find(1);
        if(!$about){
            $about = About::create(['content'=>'context here']);
        }

        $this->text = $about->content;
        $this->title = $about->title;
    }
    
    public function render()
    {
        return view('livewire.about-page');
    }
}
